<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meals extends Model
{
    protected $fillable = [
        'title',
        'description',
        'time',
        'is_substitute',
        'skipped',
        'justification'
    ];

    protected $casts = [
        'is_substitute' => 'boolean',
        'skipped' => 'boolean',
    ];

    public function diets()
{
    return $this->belongsToMany(Diets::class, 'diets_meals')
                ->using(DietMeals::class)
                ->withTimestamps();
}

    public function foods()
    {
        return $this->belongsToMany(Foods::class, 'meals_foods')
            ->withPivot(['quantity', 'unit'])
            ->withTimestamps();
    }
}
