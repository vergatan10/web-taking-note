<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use App\Http\Requests\CreateNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Models\User;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Note::with(['owner'])
            ->withCount(['comments', 'sharedWith'])
            ->where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(9);
        return view('note.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('note.form', [
            'data' => new Note(),
            'method' => 'POST',
            'action' => route('notes.store'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateNoteRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = auth()->user()->id;
        Note::create($validated);
        return redirect()->route('notes')->with('success_alert', 'Note created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        if ($note->user_id !== auth()->user()->id) {
            return redirect()->route('notes')->with('error', 'You are not owner of this note.');
        }
        $note->load(['owner', 'sharedWith', 'comments']);
        $users = User::where('id', '!=', auth()->user()->id)->get();
        return view('note.form', [
            'data' => $note,
            'users' => $users,
            'method' => 'PUT',
            'action' => route('notes.update', $note->id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoteRequest $request, Note $note)
    {
        $validated = $request->validated();
        if ($note->user_id !== auth()->user()->id) {
            return redirect()->route('notes')->with('error', 'You are not owner of this note.');
        }
        $note->update($validated);

        if ($validated['is_public'] == 1) {
            $note->sharedWith()->sync([]);
        }
        return redirect()->route('notes')->with('success_alert', 'Note updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        if ($note->user_id !== auth()->user()->id) {
            return redirect()->route('notes')->with('error', 'You are not owner of this note.');
        }
        $note->delete();
        return redirect()->route('notes')->with('success_alert', 'Note deleted successfully');
    }

    public function detail(Note $note)
    {
        $note->load(['owner', 'sharedWith', 'comments']);
        return view('note.detail', compact('note'));
    }

    public function share(Note $note, Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);
        if (!$note->sharedWith()->where('user_id', $validated['user_id'])->exists()) {
            $note->sharedWith()->attach($validated['user_id']);
        }
        return redirect()->back()->with('success_alert', 'Note shared successfully');
    }

    public function unshare(Note $note, Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);
        $note->sharedWith()->detach($validated['user_id']);
        return redirect()->back()->with('success_alert', 'Note unshared successfully');
    }

    public function comment(Note $note, Request $request)
    {
        $validated = $request->validate([
            'comment' => 'required|string|max:255',
        ]);
        $validated['user_id'] = auth()->user()->id;
        $note->comments()->create($validated);
        return redirect()->back()->with('success_alert', 'Comment added successfully');
    }
}
