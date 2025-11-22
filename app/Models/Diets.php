<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diets extends Model
{
    protected $fillable = [
        'nutritionist_id',
        'title',
        'description'
    ];

    public function nutritionist()
    {
        return $this->belongsTo(Nutritionist::class);
    }

    public function templateMeals()
    {
        return $this->hasMany(DietMeals::class);
    }
}
