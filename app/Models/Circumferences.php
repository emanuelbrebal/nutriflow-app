<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Circumferences extends Model
{
    protected $table = "circumferences";

    protected $fillable = [
        'circ_neck_mm',
        'circ_chest_mm',
        'circ_waist_mm',
        'circ_abdomen_mm',
        'circ_hip_mm',
        'circ_arm_mm',
        'circ_thigh_mm',
        'circ_calf_mm'
    ];

    public function physicalEvaluation()
    {
        return $this->belongsTo(PhysicalEvaluations::class);
    }

}
