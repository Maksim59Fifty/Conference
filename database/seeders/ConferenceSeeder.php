<?php

namespace Database\Seeders;

use App\Models\Conference;
use Illuminate\Database\Seeder;

class ConferenceSeeder extends Seeder
{
    public function run(): void
    {
        // A past conference
        Conference::firstOrCreate(
            ['title' => 'Past Conference Example'],
            [
                'description' => 'This conference has already taken place.',
                'lecturers'   => 'Dr. Eve Fox',
                'date'        => '2024-01-10',
                'time'        => '14:00',
                'address'     => 'Old Building',
            ]
        );

        // Future conferences
        Conference::firstOrCreate(
            ['title' => 'Web Technologies 2025'],
            [
                'description' => 'Annual conference on modern web development.',
                'lecturers'   => 'Dr. Alice Brown, Prof. Bob Wilson',
                'date'        => '2026-06-15',
                'time'        => '09:00',
                'address'     => 'Main Hall, University Building A',
            ]
        );

        Conference::firstOrCreate(
            ['title' => 'AI and Machine Learning'],
            [
                'description' => 'Exploring the future of artificial intelligence.',
                'lecturers'   => 'Dr. Carol Davis, Dr. Dave Evans',
                'date'        => '2026-07-20',
                'time'        => '10:00',
                'address'     => 'Conference Center, Room 101',
            ]
        );

        // Extra random ones
        Conference::factory(4)->create();
    }
}
