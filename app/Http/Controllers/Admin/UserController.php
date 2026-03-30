<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display list of all system users.
     */
    public function index(): View
    {
        $users = User::with('roles')->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(int $id): View
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user (name, surname, email).
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email,' . $id,
        ], [], [
            'first_name' => __('validation.attributes.first_name'),
            'last_name'  => __('validation.attributes.last_name'),
            'email'      => __('validation.attributes.email'),
        ]);

        $user->update(array_merge($validated, [
            'name' => $validated['first_name'] . ' ' . $validated['last_name'],
        ]));

        return redirect()->route('admin.users.index')
            ->with('success', __('messages.admin.user_updated'));
    }
}
