<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Foods extends Model
{
    protected $table = 'foods';

    protected $fillable = [
        'name',
        'photo_path',
        'calories',
        'carbos',
        'fats',
        'proteins'
    ];

    public function meals()
    {
        return $this->belongsToMany(Meals::class, 'meals_foods')
            ->withPivot(['quantity', 'unit']);
    }
}
