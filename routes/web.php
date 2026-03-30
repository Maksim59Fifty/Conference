<?php

/**
 * SD1: Conference system routes - home, client, employee, admin subsystems.
 */

use App\Http\Controllers\Admin\ConferenceController as AdminConferenceController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Client\ConferenceController as ClientConferenceController;
use App\Http\Controllers\Employee\ConferenceController as EmployeeConferenceController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('client')->name('client.')->group(function () {
    Route::get('conferences', [ClientConferenceController::class, 'index'])->name('conferences.index');
    Route::get('conferences/{id}', [ClientConferenceController::class, 'show'])->name('conferences.show');
    Route::post('conferences/{id}/register', [ClientConferenceController::class, 'register'])->name('conferences.register');
});

Route::prefix('employee')->name('employee.')->group(function () {
    Route::get('conferences', [EmployeeConferenceController::class, 'index'])->name('conferences.index');
    Route::get('conferences/{id}', [EmployeeConferenceController::class, 'show'])->name('conferences.show');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('users/{id}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
    Route::put('users/{id}', [AdminUserController::class, 'update'])->name('users.update');
    Route::resource('conferences', AdminConferenceController::class)->except(['show'])->names('conferences');
});
