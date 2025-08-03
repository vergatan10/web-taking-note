<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $filter = request('filter');

        $data = Note::withCount('comments')->with(['owner', 'sharedWith'])
            ->where(function ($query) use ($user, $filter) {
                if ($filter == 'public') {
                    $query->where('is_public', 1);
                } elseif ($filter == 'shared') {
                    $query->whereExists(function ($subQuery) use ($user) {
                        $subQuery->selectRaw(1)
                            ->from('user_note')
                            ->whereColumn('notes.id', 'user_note.note_id')
                            ->where('user_note.user_id', $user->id);
                    });
                } else {
                    $query->where('is_public', 1)
                        ->orWhereExists(function ($subQuery) use ($user) {
                            $subQuery->selectRaw(1)
                                ->from('user_note')
                                ->whereColumn('notes.id', 'user_note.note_id')
                                ->where('user_note.user_id', $user->id);
                        });
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate(9);
        return view('home.index', compact('data'));
    }
}
