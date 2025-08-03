<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        if (auth()->user()->role != 'ADMIN') {
            return redirect()->route('home')->with('error', 'You are not authorized to access the page.');
        }
        $data = User::withCount('notes')->paginate(10);
        return view('user.index', compact('data'));
    }

    public function profile()
    {
        $user = auth()->user();
        return view('user.profile', compact('user'));
    }

    public function destroy($id)
    {
        if (auth()->user()->role != 'ADMIN') {
            return redirect()->route('home')->with('error', 'You are not authorized to access the page.');
        }
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users')->with('success_alert', 'User deleted successfully');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $validated = $request->validated();
        $user = auth()->user();
        $user->password = Hash::make($validated['password']);
        $user->save();
        return redirect()->back()->with('success_alert', 'Password changed successfully');
    }

    public function deleteAccount()
    {
        $user = auth()->user();
        $user->delete();
        return redirect()->route('login')->with('success', 'Account deleted successfully');
    }
}
