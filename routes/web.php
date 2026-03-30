<?php

use App\Http\Controllers\Admin\ConferenceController as AdminConferenceController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Client\ConferenceController as ClientConferenceController;
use App\Http\Controllers\Employee\ConferenceController as EmployeeConferenceController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// ─── Public ───────────────────────────────────────────────────────────────────

Route::get('/', [HomeController::class, 'index'])->name('home');

// ─── Auth ─────────────────────────────────────────────────────────────────────

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login.post');

    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register'])->name('register.post');
});

Route::post('logout', [LoginController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// ─── Client ───────────────────────────────────────────────────────────────────

Route::prefix('client')
    ->name('client.')
    ->middleware(['auth', 'role:client'])
    ->group(function () {
        Route::get('conferences', [ClientConferenceController::class, 'index'])->name('conferences.index');
        Route::get('conferences/{id}', [ClientConferenceController::class, 'show'])->name('conferences.show');
        Route::post('conferences/{id}/register', [ClientConferenceController::class, 'register'])->name('conferences.register');
    });

// ─── Employee ─────────────────────────────────────────────────────────────────

Route::prefix('employee')
    ->name('employee.')
    ->middleware(['auth', 'role:employee,admin'])
    ->group(function () {
        Route::get('conferences', [EmployeeConferenceController::class, 'index'])->name('conferences.index');
        Route::get('conferences/{id}', [EmployeeConferenceController::class, 'show'])->name('conferences.show');
    });

// ─── Admin ────────────────────────────────────────────────────────────────────

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('users', [AdminUserController::class, 'index'])->name('users.index');
        Route::get('users/{id}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
        Route::put('users/{id}', [AdminUserController::class, 'update'])->name('users.update');

        Route::resource('conferences', AdminConferenceController::class)
            ->except(['show'])
            ->names('conferences');
    });
