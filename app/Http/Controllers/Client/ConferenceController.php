<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\ConferenceStorage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ConferenceController extends Controller
{
    public function __construct(
        private ConferenceStorage $conferenceStorage
    ) {}

    /**
     * Display list of conferences for client (planned only or all with register/view actions).
     */
    public function index(): View
    {
        $conferences = $this->conferenceStorage->getAll();
        return view('client.conferences.index', compact('conferences'));
    }

    /**
     * Display the specified conference.
     */
    public function show(int $id): View|RedirectResponse
    {
        $conference = $this->conferenceStorage->find($id);
        if (!$conference) {
            abort(404);
        }
        return view('client.conferences.show', compact('conference'));
    }

    /**
     * Process client registration for a conference.
     */
    public function register(Request $request, int $id): RedirectResponse
    {
        $conference = $this->conferenceStorage->find($id);
        if (!$conference) {
            abort(404);
        }

        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_email' => 'required|email',
        ]);

        $this->conferenceStorage->addRegistration($id, [
            'name' => $validated['client_name'],
            'email' => $validated['client_email'],
        ]);

        return redirect()->route('client.conferences.show', $id)
            ->with('success', __('messages.client.register_success'));
    }
}
