<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'patients';

    protected $fillable = [
        'user_id',
        'linked_nutritionist',
        'birth_date',
        'height',
        'weight',
        'biological_sex',
        'activity_level',
        'main_objective',
    ];

    protected $casts = [
        'data_nascimento' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function nutritionist()
    {
        return $this->belongsTo(Nutritionist::class, 'linked_nutritionist');
    }
}
