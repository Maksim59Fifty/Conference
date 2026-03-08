<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConferenceRequest;
use App\Http\Requests\UpdateConferenceRequest;
use App\Services\ConferenceStorage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ConferenceController extends Controller
{
    public function __construct(
        private ConferenceStorage $conferenceStorage
    ) {}

    /**
     * Display list of conferences with create, edit, delete actions.
     */
    public function index(): View
    {
        $conferences = $this->conferenceStorage->getAll();
        foreach ($conferences as $id => $conf) {
            $conferences[$id]['is_past'] = $this->conferenceStorage->isPast($conf);
        }
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
        $this->conferenceStorage->store($request->validated());
        return redirect()->route('admin.conferences.index')
            ->with('success', __('messages.admin.conference_created'));
    }

    /**
     * Show the form for editing the specified conference.
     */
    public function edit(int $conference): View|RedirectResponse
    {
        $conferenceData = $this->conferenceStorage->find($conference);
        if (!$conferenceData) {
            abort(404);
        }
        return view('admin.conferences.edit', ['conference' => $conferenceData]);
    }

    /**
     * Update the specified conference.
     */
    public function update(UpdateConferenceRequest $request, int $conference): RedirectResponse
    {
        $conferenceData = $this->conferenceStorage->find($conference);
        if (!$conferenceData) {
            abort(404);
        }
        $this->conferenceStorage->update($conference, $request->validated());
        return redirect()->route('admin.conferences.index')
            ->with('success', __('messages.admin.conference_updated'));
    }

    /**
     * Remove the specified conference (only if not in the past).
     */
    public function destroy(int $conference): RedirectResponse
    {
        $conferenceData = $this->conferenceStorage->find($conference);
        if (!$conferenceData) {
            abort(404);
        }
        if ($this->conferenceStorage->isPast($conferenceData)) {
            return redirect()->route('admin.conferences.index')
                ->with('error', __('messages.admin.cannot_delete_past'));
        }
        if (!$this->conferenceStorage->delete($conference)) {
            return redirect()->route('admin.conferences.index')
                ->with('error', __('messages.admin.cannot_delete_past'));
        }
        return redirect()->route('admin.conferences.index')
            ->with('success', __('messages.admin.conference_deleted'));
    }
}
