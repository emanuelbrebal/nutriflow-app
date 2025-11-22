<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'birth_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function nutritionist()
    {
        return $this->belongsTo(Nutritionist::class, 'linked_nutritionist');
    }

    public function protocols()
    {
        return $this->hasMany(Protocols::class);
    }

    public function activeProtocol()
    {
        return $this->hasOne(Protocols::class)->where('is_active', true);
    }
}
