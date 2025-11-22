<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\AccountTypeEnum;
use App\Enums\PlanLevelEnum;
use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Casts\Attribute; 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_code',
        'account_type',
        'plan_level',
        'account_status',
        'mobile_number',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'account_type' => AccountTypeEnum::class,
            'plan_level' => PlanLevelEnum::class,
            'account_status' => StatusEnum::class,
        ];
    }

    protected static function booted()
    {
        static::creating(function ($user) {
            if (empty($user->user_code)) {
                $user->user_code = self::generateUniqueCode();
            }
        });
    }

    private static function generateUniqueCode()
    {
        do {
            $code = strtoupper(Str::random(6));
        } while (self::where('user_code', $code)->exists());

        return $code;
    }

    protected $appends = [
        'plan_label', 
        'account_type_label' 
    ];

    protected function planLabel(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->plan_level?->getLabel(),
        );
    }

    protected function accountTypeLabel(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->account_type?->getLabel(),
        );
    }


    public function nutritionist()
    {
        return $this->hasOne(Nutritionist::class);
    }

    public function isNutritionist() {
        return $this->account_type === AccountTypeEnum::Nutritionist; 
    }

    public function patient()
    {
        return $this->hasOne(Patient::class);
    }
}