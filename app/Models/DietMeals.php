<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DietMeals extends Model
{
    protected $fillable = [
        'diet_id',
        'title', 
        'order', 
    ];

    public function diet()
    {
        return $this->belongsTo(Diets::class);
    }

    public function foods()
    {
        return $this->belongsToMany(Foods::class, 'diet_meal_foods')
            ->withPivot(['quantity', 'unit']);
    }
}