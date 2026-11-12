<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    protected $table = 'CJ_events';
    protected $primaryKey = 'CJ_id';
    public $timestamps = true;

    protected $fillable = [
        'CJ_title',
        'CJ_description',
        'CJ_start_date',
        'CJ_end_date',
        'CJ_place',
        'CJ_price',
        'CJ_is_free',
        'CJ_capacity',
        'CJ_image',
        'CJ_category_id',
        'CJ_created_by',
        'CJ_status',
    ];

    protected $casts = [
        'CJ_start_date' => 'datetime',
        'CJ_end_date' => 'datetime',
        'CJ_price' => 'decimal:2',
        'CJ_is_free' => 'boolean',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'CJ_created_by', 'CJ_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'CJ_category_id', 'CJ_id');
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class, 'CJ_event_id', 'CJ_id');
    }

    public function registeredUsers(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'CJ_registrations',
            'CJ_event_id',
            'CJ_user_id',
            'CJ_id',
            'CJ_id'
        )->withTimestamps();
    }

    public function getAvailableSpots(): int
    {
        return $this->CJ_capacity - $this->registrations()->count();
    }

    public function hasAvailableSpots(): bool
    {
        return $this->getAvailableSpots() > 0;
    }

    public function isUserRegistered(int|string $userId): bool
    {
        return $this->registrations()
            ->where('CJ_user_id', (int) $userId)
            ->exists();
    }


    public function scopeSearch($query, string $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('CJ_title', 'like', "%{$search}%")
              ->orWhere('CJ_description', 'like', "%{$search}%")
              ->orWhere('CJ_place', 'like', "%{$search}%");
        });
    }

    public function scopeByWeekday($query, string $weekday)
    {
        $weekdayMap = [
            'Monday' => 1, 'Tuesday' => 2, 'Wednesday' => 3, 'Thursday' => 4,
            'Friday' => 5, 'Saturday' => 6, 'Sunday' => 0,
        ];

        if (isset($weekdayMap[$weekday])) {
            return $query->whereRaw('DAYOFWEEK(CJ_start_date) = ?', [$weekdayMap[$weekday] + 1]);
        }

        return $query;
    }

    public function scopeActive($query)
    {
        return $query->where('CJ_status', 'active');
    }

    public function scopeUpcoming($query)
    {
        return $query->where('CJ_start_date', '>', now());
    }
}
