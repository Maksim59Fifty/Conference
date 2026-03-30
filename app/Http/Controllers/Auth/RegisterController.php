<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisterController extends Controller
{
    /**
     * Show the registration form.
     */
    public function showRegistrationForm(): View
    {
        return view('auth.register');
    }

    /**
     * Handle registration form submission.
     * Newly registered users automatically receive the 'client' role.
     */
    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|string|min:8|confirmed',
        ], [], [
            'first_name' => __('validation.attributes.first_name'),
            'last_name'  => __('validation.attributes.last_name'),
            'email'      => __('validation.attributes.email'),
            'password'   => __('validation.attributes.password'),
        ]);

        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name'  => $validated['last_name'],
            'name'       => $validated['first_name'] . ' ' . $validated['last_name'],
            'email'      => $validated['email'],
            'password'   => Hash::make($validated['password']),
        ]);

        // Automatically assign client role
        $user->assignRole('client');

        Auth::login($user);

        return redirect()->route('client.conferences.index');
    }
}
