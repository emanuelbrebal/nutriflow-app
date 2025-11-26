<?php

namespace App\Models;

use App\Enums\NutritionistSpecialtyEnum;
use Illuminate\Database\Eloquent\Model;

class Nutritionist extends Model
{
    protected $table = 'nutritionists';

    protected $fillable = [
        'user_id',
        'crn',
        'specialty',
    ];

    protected function casts(): array
    {
        return [
            'specialty' => NutritionistSpecialtyEnum::class,
        ];
    }

    protected $appends = [
        'specialty_label',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function patients()
    {
        return $this->hasMany(Patient::class, 'linked_nutritionist');
    }

    public function getSpecialtyLabelAttribute()
    {
        return $this->specialty->getLabel();
    }
}