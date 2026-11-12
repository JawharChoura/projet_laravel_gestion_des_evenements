<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $table = 'CJ_categories';
    protected $primaryKey = 'CJ_id';
    public $timestamps = true;

    protected $fillable = [
        'CJ_name',
        'CJ_description',
    ];

  
    public function events(): HasMany
    {
        return $this->hasMany(Event::class, 'CJ_category_id', 'CJ_id');
    }
}
