<?php

namespace App\Services;

use App\Enums\AccountTypeEnum;
use App\Enums\StatusEnum;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function changePassword($request)
    {
        $passwordString = $request->input('password');
        $user = Auth::guard('web')->user();

        if (!Hash::check($passwordString, $user->password)) {
            $user->update([
                'password' => Hash::make($passwordString)
            ]);
            return true;
        }

        return false;
    }


    public function deleteAccount()
    {
        $user = Auth::guard('web')->user();

        if ($user->account_status != StatusEnum::Inactive) {
            $user->update(
                [
                    'account_status' => StatusEnum::Inactive
                ]
            );
            return true;
        }
        return false;
    }
}
