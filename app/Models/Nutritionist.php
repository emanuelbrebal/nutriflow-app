<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nutricionista extends Model
{
    protected $table = 'nutritionists';

    protected $fillable = [
        'user_id',
        'crn',
        'specialty',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function patients()
    {
        return $this->hasMany(Patient::class, 'linked_nutritionist');
    }
}