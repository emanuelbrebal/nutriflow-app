<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhysicalEvaluations extends Model
{
    protected $table = 'physical_evaluations';

    protected $fillable = [
        'user_id',
        'is_previous',
        'evaluation_date',
        'observations',
    ];

    protected $casts = [
        'is_previous' => 'boolean',
        'evaluation_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function result()
    {
        return $this->hasOne(Results::class);
    }
    
    public function circumferences()
    {
        return $this->hasOne(Circumferences::class);
    }

    public function skinFolds()
    {
        return $this->hasOne(SkinFolds::class);
    }

}
