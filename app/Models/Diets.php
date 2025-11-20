<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diets extends Model
{
    protected $fillable = [
        'title',
        'description'
    ];

    public function meals()
    {
        return $this->belongsToMany(Meals::class, 'diets_meals')
            ->using(DietMeals::class)
            ->withTimestamps();
    }

    public function protocols()
    {
        return $this->hasMany(Protocols::class);
    }
}
