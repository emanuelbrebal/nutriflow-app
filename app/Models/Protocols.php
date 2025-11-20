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
        'message'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'objective' => ObjectivesEnum::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function diet()
    {
        return $this->belongsTo(Diets::class);
    }
}
