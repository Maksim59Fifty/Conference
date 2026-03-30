<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConferenceRequest;
use App\Http\Requests\UpdateConferenceRequest;
use App\Models\Conference;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ConferenceController extends Controller
{
    /**
     * Display list of conferences with create, edit, delete actions.
     */
    public function index(): View
    {
        $conferences = Conference::orderBy('date', 'desc')->get();
        return view('admin.conferences.index', compact('conferences'));
    }

    /**
     * Show the form for creating a new conference.
     */
    public function create(): View
    {
        $conference = null;
        return view('admin.conferences.create', compact('conference'));
    }

    /**
     * Store a newly created conference.
     */
    public function store(StoreConferenceRequest $request): RedirectResponse
    {
        Conference::create($request->validated());

        return redirect()->route('admin.conferences.index')
            ->with('success', __('messages.admin.conference_created'));
    }

    /**
     * Show the form for editing the specified conference.
     */
    public function edit(int $conference): View
    {
        $conference = Conference::findOrFail($conference);
        return view('admin.conferences.edit', compact('conference'));
    }

    /**
     * Update the specified conference.
     */
    public function update(UpdateConferenceRequest $request, int $conference): RedirectResponse
    {
        $conference = Conference::findOrFail($conference);
        $conference->update($request->validated());

        return redirect()->route('admin.conferences.index')
            ->with('success', __('messages.admin.conference_updated'));
    }

    /**
     * Remove the specified conference (only if not in the past).
     */
    public function destroy(int $conference): RedirectResponse
    {
        $conference = Conference::findOrFail($conference);

        if ($conference->isPast()) {
            return redirect()->route('admin.conferences.index')
                ->with('error', __('messages.admin.cannot_delete_past'));
        }

        $conference->delete();

        return redirect()->route('admin.conferences.index')
            ->with('success', __('messages.admin.conference_deleted'));
    }
}
