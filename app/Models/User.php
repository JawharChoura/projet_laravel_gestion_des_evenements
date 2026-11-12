<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'CJ_users';
    protected $primaryKey = 'CJ_id';

    protected $fillable = [
        'CJ_name',
        'CJ_email',
        'CJ_password',
        'CJ_role',
    ];

    protected $hidden = [
        'CJ_password',
        'remember_token',
    ];

    public function getAuthPasswordName(): string
    {
        return 'CJ_password';
    }

    protected function casts(): array
    {
        return [
            'CJ_password' => 'hashed',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->CJ_role === 'admin';
    }

    public function createdEvents(): HasMany
    {
        return $this->hasMany(Event::class, 'CJ_created_by', 'CJ_id');
    }

    public function registeredEvents(): BelongsToMany
    {
        return $this->belongsToMany(
            Event::class,
            'CJ_registrations',
            'CJ_user_id',
            'CJ_event_id',
            'CJ_id',
            'CJ_id'
        )->withTimestamps();
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class, 'CJ_user_id', 'CJ_id');
    }
}

