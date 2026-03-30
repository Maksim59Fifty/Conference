<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Conference;
use Illuminate\View\View;

class ConferenceController extends Controller
{
    /**
     * Display list of all conferences (past and planned), read-only.
     */
    public function index(): View
    {
        $conferences = Conference::orderBy('date', 'desc')->get();
        return view('employee.conferences.index', compact('conferences'));
    }

    /**
     * Display the specified conference with registered clients.
     */
    public function show(int $id): View
    {
        $conference = Conference::with('registeredUsers')->findOrFail($id);
        return view('employee.conferences.show', compact('conference'));
    }
}
