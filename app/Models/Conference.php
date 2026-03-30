<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Conference extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'lecturers',
        'date',
        'time',
        'address',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function registeredUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users_conferences');
    }

    public function isPast(): bool
    {
        $dateTime = $this->date->format('Y-m-d') . ' ' . ($this->time ?? '00:00');
        return strtotime($dateTime) < time();
    }
}
