<?php

namespace App\Http\Controllers;

use App\Enums\AccountTypeEnum;
use App\Enums\ActivityLevelEnum;
use App\Enums\BiologicalSexEnum;
use App\Enums\NutritionistSpecialtyEnum;
use App\Enums\ObjectivesEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserController extends Controller
{
     public function redirectMyProfile()
    {
        $user = Auth::user();

        if ($user->account_type == AccountTypeEnum::Nutritionist) {
            $user->load(['nutritionist']);
            return Inertia::render('Nutritionist/MyProfile', [
                'user' => $user,
                'enums' => NutritionistSpecialtyEnum::options()
            ]);
        }
        
        $user->load(['patient.nutritionist.user']);

        return Inertia::render('User/MyProfile', [
            'user' => $user,
            'enums' => $this->getEnums()
        ]);
    }
    
    private function getEnums(): array
    {
        return [
            'objectives' => ObjectivesEnum::options(),
            'activity_levels' => ActivityLevelEnum::options(),
            'biological_sex' => BiologicalSexEnum::options(),
        ];
    }
}
