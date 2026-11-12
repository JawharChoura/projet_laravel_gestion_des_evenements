<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Registration extends Model
{
    use HasFactory;

    protected $table = 'CJ_registrations';
    protected $primaryKey = 'CJ_id';
    public $timestamps = true;

    protected $fillable = [
        'CJ_user_id',
        'CJ_event_id',
    ];

  
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'CJ_user_id', 'CJ_id');
    }

  
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'CJ_event_id', 'CJ_id');
    }
}
