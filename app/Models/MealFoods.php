<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class MealFoods extends Pivot
{
    protected $table = 'meals_foods'; 

    public $incrementing = true;

    public function getFormattedQuantityAttribute()
    {
        return $this->quantity . $this->unit;
    }
}