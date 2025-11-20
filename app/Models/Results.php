<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Results extends Model
{

    protected $fillable = [
        'physical_evaluation_id',
        'imc',
        'body_fat_percentage',
        'fat_mass',
        'light_mass',
        'basal_metabolic_rate',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

   public function physicalEvaluation()
    {
        return $this->belongsTo(PhysicalEvaluations::class);
    }
}
