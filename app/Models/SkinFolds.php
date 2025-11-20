<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkinFolds extends Model
{
    protected $table = "skin_folds";

    protected $fillable = [
        'fold_triceps_mm',
        'fold_biceps_mm',
        'fold_subscapular_mm',
        'fold_chest_mm',
        'fold_midaxillary_mm',
        'fold_suprailiac_mm',
        'fold_abdominal_mm',
        'fold_thigh_mm',
        'fold_calf_mm',
    ];

    public function physicalEvaluation()
    {
        return $this->belongsTo(PhysicalEvaluations::class);
    }
}
