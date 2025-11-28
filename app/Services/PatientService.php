<?php

namespace App\Services;

use App\Enums\AccountTypeEnum;
use App\Enums\StatusEnum;
use App\Http\Requests\PatientOnboardingUpdateRequest;
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

    public function updateProfile(User $user, PatientOnboardingUpdateRequest $request): void
    {
        $userData = $request->only(['name', 'mobile_number']);
        $userData['account_status'] = StatusEnum::Active->value;

        if ($request->hasFile('profile_picture')) {
            $photo = $request->file('profile_picture');
            $newPath = $this->handleProfilePictureUpload($user, $photo);
            $userData['profile_picture_path'] = $newPath;
        }

        $user->update($userData);

        $patientData = $request->only([
            'birth_date',
            'biological_sex',
            'height',
            'weight',
            'main_objective',
            'activity_level'
        ]);

        $user->patient()->updateOrCreate(
            ['user_id' => $user->id],
            $patientData
        );
    }


    private function handleProfilePictureUpload(User $user, UploadedFile $photo): string
    {
        $oldPath = $user->profile_picture_path;
        if ($oldPath && Storage::disk('public')->exists($oldPath)) {
            Storage::disk('public')->delete($oldPath);
        }

        $newPath = $photo->store('avatars', 'public');

        return $newPath;
    }

    public function deactivateAccount(User $user): bool
    {
        if ($user->account_status == StatusEnum::Inactive) {
            return false;
        }

        $user->update(['account_status' => StatusEnum::Inactive]);

        return true;
    }
}
