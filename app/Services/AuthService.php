<?php

namespace App\Services;

use App\Enums\AccountTypeEnum;
use App\Enums\PlanLevelEnum;
use App\Enums\StatusEnum;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function authenticate(string $email, string $password, bool $remember = false): bool
    {
        return Auth::attempt(['email' => $email, 'password' => $password], $remember);
    }

    public function registerUser(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'account_type' => $data['account_type'],
            'account_status' => StatusEnum::Incomplete,
            'mobile_number' => null,
            'plan_level' => PlanLevelEnum::Free,
        ]);
    }

    public function logout(): void
    {
        Auth::guard('web')->logout();
    }
}