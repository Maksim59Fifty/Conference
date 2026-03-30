<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole    = Role::where('name', 'admin')->first();
        $employeeRole = Role::where('name', 'employee')->first();
        $clientRole   = Role::where('name', 'client')->first();

        // Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'first_name' => 'Admin',
                'last_name'  => 'User',
                'name'       => 'Admin User',
                'password'   => Hash::make('password'),
            ]
        );
        $admin->roles()->syncWithoutDetaching([$adminRole->id]);

        // Employee
        $employee = User::firstOrCreate(
            ['email' => 'employee@example.com'],
            [
                'first_name' => 'Employee',
                'last_name'  => 'User',
                'name'       => 'Employee User',
                'password'   => Hash::make('password'),
            ]
        );
        $employee->roles()->syncWithoutDetaching([$employeeRole->id]);

        // Client
        $client = User::firstOrCreate(
            ['email' => 'client@example.com'],
            [
                'first_name' => 'Client',
                'last_name'  => 'User',
                'name'       => 'Client User',
                'password'   => Hash::make('password'),
            ]
        );
        $client->roles()->syncWithoutDetaching([$clientRole->id]);

        // Extra random clients
        User::factory(5)->create()->each(function (User $user) use ($clientRole) {
            $user->roles()->syncWithoutDetaching([$clientRole->id]);
        });
    }
}
