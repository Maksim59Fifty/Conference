<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

class ConferenceStorage
{
    private const SESSION_KEY = 'sd1_conferences';

    private const REGISTRATIONS_KEY = 'sd1_registrations';

    /**
     * Get all conferences (merge config with session-stored ones).
     */
    public function getAll(): array
    {
        $fromConfig = config('conferences.items', []);
        $fromSession = Session::get(self::SESSION_KEY, []);
        $merged = $fromConfig;
        foreach ($fromSession as $id => $item) {
            $merged[$id] = $item;
        }
        ksort($merged);
        return $merged;
    }

    /**
     * Find conference by id.
     */
    public function find(int $id): ?array
    {
        $all = $this->getAll();
        return $all[$id] ?? null;
    }

    /**
     * Store a new conference (in session for SD1).
     */
    public function store(array $data): array
    {
        $items = Session::get(self::SESSION_KEY, []);
        $newId = $items ? (max(array_keys($items)) + 1) : 100;
        $items[$newId] = array_merge($data, ['id' => $newId]);
        Session::put(self::SESSION_KEY, $items);
        return $items[$newId];
    }

    /**
     * Update conference by id (session stores overrides; config items are copied to session on first update).
     */
    public function update(int $id, array $data): bool
    {
        $current = $this->find($id);
        if (!$current) {
            return false;
        }
        $items = Session::get(self::SESSION_KEY, []);
        $items[$id] = array_merge($current, $data, ['id' => $id]);
        Session::put(self::SESSION_KEY, $items);
        return true;
    }

    /**
     * Delete conference by id (only if not in the past).
     */
    public function delete(int $id): bool
    {
        $conference = $this->find($id);
        if (!$conference) {
            return false;
        }
        $dateTime = $conference['date'] . ' ' . ($conference['time'] ?? '00:00');
        if (strtotime($dateTime) < time()) {
            return false;
        }
        $items = Session::get(self::SESSION_KEY, []);
        unset($items[$id]);
        Session::put(self::SESSION_KEY, $items);
        $registrations = Session::get(self::REGISTRATIONS_KEY, []);
        unset($registrations[$id]);
        Session::put(self::REGISTRATIONS_KEY, $registrations);
        return true;
    }

    /**
     * Check if conference is in the past.
     */
    public function isPast(array $conference): bool
    {
        $dateTime = $conference['date'] . ' ' . ($conference['time'] ?? '00:00');
        return strtotime($dateTime) < time();
    }

    /**
     * Add registration for a conference (client).
     */
    public function addRegistration(int $conferenceId, array $clientData): void
    {
        $registrations = Session::get(self::REGISTRATIONS_KEY, []);
        if (!isset($registrations[$conferenceId])) {
            $registrations[$conferenceId] = [];
        }
        $registrations[$conferenceId][] = $clientData;
        Session::put(self::REGISTRATIONS_KEY, $registrations);
    }

    /**
     * Get registrations for a conference.
     */
    public function getRegistrations(int $conferenceId): array
    {
        $registrations = Session::get(self::REGISTRATIONS_KEY, []);
        return $registrations[$conferenceId] ?? [];
    }
}
