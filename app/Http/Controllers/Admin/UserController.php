<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\UserStorage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct(
        private UserStorage $userStorage
    ) {}

    /**
     * Display list of all system users.
     */
    public function index(): View
    {
        $users = $this->userStorage->getAll();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(int $id): View|RedirectResponse
    {
        $user = $this->userStorage->find($id);
        if (!$user) {
            abort(404);
        }
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user (server-side validation: name, surname, email required).
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
        ], [], [
            'first_name' => __('validation.attributes.first_name'),
            'last_name' => __('validation.attributes.last_name'),
            'email' => __('validation.attributes.email'),
        ]);

        $user = $this->userStorage->find($id);
        if (!$user) {
            abort(404);
        }

        $this->userStorage->update($id, $validated);

        return redirect()->route('admin.users.index')
            ->with('success', __('messages.admin.user_updated'));
    }
}
