<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Services\ConferenceStorage;
use Illuminate\View\View;

class ConferenceController extends Controller
{
    public function __construct(
        private ConferenceStorage $conferenceStorage
    ) {}

    /**
     * Display list of all conferences (past and planned), read-only.
     */
    public function index(): View
    {
        $conferences = $this->conferenceStorage->getAll();
        return view('employee.conferences.index', compact('conferences'));
    }

    /**
     * Display the specified conference with registered clients list.
     */
    public function show(int $id): View
    {
        $conference = $this->conferenceStorage->find($id);
        if (!$conference) {
            abort(404);
        }
        $registrations = $this->conferenceStorage->getRegistrations($id);
        return view('employee.conferences.show', compact('conference', 'registrations'));
    }
}
