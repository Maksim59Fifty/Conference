<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

class UserStorage
{
    private const SESSION_KEY = 'sd1_users';

    /**
     * Get all users (merge config with session overrides).
     */
    public function getAll(): array
    {
        $fromConfig = config('users.items', []);
        $overrides = Session::get(self::SESSION_KEY, []);
        $result = [];
        foreach ($fromConfig as $id => $user) {
            $result[$id] = $overrides[$id] ?? $user;
        }
        return $result;
    }

    /**
     * Find user by id.
     */
    public function find(int $id): ?array
    {
        $all = $this->getAll();
        return $all[$id] ?? null;
    }

    /**
     * Update user (store override in session for SD1).
     */
    public function update(int $id, array $data): bool
    {
        $user = $this->find($id);
        if (!$user) {
            return false;
        }
        $overrides = Session::get(self::SESSION_KEY, []);
        $overrides[$id] = array_merge($user, $data, ['id' => $id]);
        Session::put(self::SESSION_KEY, $overrides);
        return true;
    }
}
