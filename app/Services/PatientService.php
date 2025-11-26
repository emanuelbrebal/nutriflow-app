<?php

namespace App\Services;

use App\Enums\AccountTypeEnum;
use App\Enums\StatusEnum;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PatientService
{
    public function linkNutritionist(User $patientUser, string $code): array
    {
        $nutritionistUser = User::where('user_code', $code)
            ->where('account_type', AccountTypeEnum::Nutritionist)
            ->first();

        if (!$nutritionistUser || $nutritionistUser->account_status == StatusEnum::Inactive) {
            return [
                'success' => false,
                'type' => 'validation', 
                'message' => 'Este código não pertence a um nutricionista ativo.'
            ];
        }

        $patient = $patientUser->patient;

        if (!$patient) {
            return [
                'success' => false,
                'type' => 'flash', 
                'message' => 'Complete seu perfil de paciente antes de vincular.'
            ];
        }

        $patient->update([
            'linked_nutritionist' => $nutritionistUser->nutritionist->id
        ]);

        return [
            'success' => true,
            'nutritionist_name' => $nutritionistUser->name
        ];
    }

    public function unlinkNutritionist(User $user): void
    {
        if ($user->patient) {
            $user->patient->update(['linked_nutritionist' => null]);
        }
    }

    
    public function updateProfile(User $user, array $userData, array $patientData, ?UploadedFile $photo = null, bool $activateAccount = false): void
    {
        if ($photo) {
            $this->handleProfilePictureUpload($user, $photo, $userData);
        }

        if ($activateAccount) {
            $userData['account_status'] = StatusEnum::Active;
        }

        $user->update($userData);

        $user->patient()->updateOrCreate(
            ['user_id' => $user->id],
            $patientData
        );
    }

    public function deactivateAccount(User $user): bool
    {
        if ($user->account_status == StatusEnum::Inactive) {
            return false;
        }

        $user->update(['account_status' => StatusEnum::Inactive]);
        
        return true;
    }

    private function handleProfilePictureUpload(User $user, UploadedFile $photo, array &$userData): void
    {
        if ($user->profile_picture_path && Storage::disk('public')->exists($user->profile_picture_path)) {
            Storage::disk('public')->delete($user->profile_picture_path);
        }

        $path = $photo->store('avatars', 'public');
        $userData['profile_picture_path'] = $path;
    }
}