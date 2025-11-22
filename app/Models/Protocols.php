<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\ObjectivesEnum;

class Protocols extends Model
{
    protected $fillable = [
        'user_id',
        'diet_id',
        'start_date',
        'end_date',
        'objective',
        'message',
        'is_active'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'objective' => ObjectivesEnum::class,
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function meals()
    {
        return $this->hasMany(Meals::class);
    }
    
}
