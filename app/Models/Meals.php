<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meals extends Model
{
    protected $fillable = [
        'protocol_id',
        'title',
        'description',
        'time',
        'is_substitute',
        'skipped',
        'justification'
    ];

    protected $casts = [
        'is_substitute' => 'boolean',
        'skipped' => 'boolean',
    ];

    public function protocol()
    {
        return $this->belongsTo(Protocols::class);
    }

    public function foods()
    {
        return $this->belongsToMany(Foods::class, 'meals_foods')
            ->withPivot(['quantity', 'unit'])
            ->withTimestamps();
    }
}
