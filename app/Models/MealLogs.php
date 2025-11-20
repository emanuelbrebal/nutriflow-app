<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealLogs extends Model
{
    protected $fillable = [
        'user_id', 'meal_id', 'eaten_at', 'photo_path', 'notes'
    ];

    protected $casts = [
        'eaten_at' => 'datetime',
    ];

    public function plannedMeal()
    {
        return $this->belongsTo(Meals::class, 'meal_id');
    }

    public function items()
    {
        return $this->hasMany(MealLogItems::class);
    }
}