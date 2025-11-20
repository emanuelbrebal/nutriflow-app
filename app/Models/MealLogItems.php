<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealLogItems extends Model
{
    protected $fillable = [
        'meal_log_id', 'food_id', 
        'food_name', 'quantity', 'unit', 
        'calories', 'protein'
    ];

    public function mealLog()
    {
        return $this->belongsTo(MealLogs::class);
    }

    public function originalFood()
    {
        return $this->belongsTo(Foods::class, 'food_id');
    }
}