<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of users (admin only).
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for editing a user's role.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update user's role.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,member',
        ]);

        $user->update([
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')
            ->with('success', "Role user '{$user->name}' berhasil diupdate menjadi '{$request->role}'.");
    }
}
