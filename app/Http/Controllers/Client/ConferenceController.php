<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Conference;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ConferenceController extends Controller
{
    /**
     * Display list of upcoming conferences for clients.
     */
    public function index(): View
    {
        $conferences = Conference::whereDate('date', '>=', today())->get();
        return view('client.conferences.index', compact('conferences'));
    }

    /**
     * Display the specified conference.
     */
    public function show(int $id): View
    {
        $conference = Conference::findOrFail($id);
        $isRegistered = Auth::check()
            ? Auth::user()->conferences()->where('conference_id', $id)->exists()
            : false;

        return view('client.conferences.show', compact('conference', 'isRegistered'));
    }

    /**
     * Register authenticated client for a conference.
     */
    public function register(Request $request, int $id): RedirectResponse
    {
        $conference = Conference::findOrFail($id);

        if ($conference->isPast()) {
            return back()->with('error', __('messages.client.cannot_register_past'));
        }

        $user = Auth::user();
        if (!$user->conferences()->where('conference_id', $id)->exists()) {
            $user->conferences()->attach($id);
        }

        return redirect()->route('client.conferences.show', $id)
            ->with('success', __('messages.client.register_success'));
    }
}
