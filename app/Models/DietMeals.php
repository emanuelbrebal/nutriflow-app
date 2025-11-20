<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class DietMeals extends Pivot
{
    protected $table = 'diets_meals';

    public $incrementing = true;

}
