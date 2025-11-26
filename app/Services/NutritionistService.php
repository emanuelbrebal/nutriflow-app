<?php

namespace App\Services;

use App\Enums\AccountTypeEnum;
use App\Enums\StatusEnum;
use App\Models\User;
use App\Models\Patient;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class NutritionistService
{
    
    public function updateProfile(User $user, array $userData, array $nutritionistData, ?UploadedFile $photo = null, bool $activateAccount = false): void
    {
        if ($photo) {
            $this->handleProfilePictureUpload($user, $photo, $userData);
        }

        if ($activateAccount) {
            $userData['account_status'] = StatusEnum::Active;
        }

        $user->update($userData);

        $user->nutritionist()->updateOrCreate(
            ['user_id' => $user->id],
            $nutritionistData
        );
    }

    public function linkPatient(User $nutritionistUser, string $patientIdentifier): array
    {
        $patientUser = User::Where('user_code', $patientIdentifier)
            ->where('account_type', AccountTypeEnum::Patient)
            ->first();

        if (!$patientUser) {
            return [
                'success' => false,
                'message' => 'Paciente não encontrado com este código.'
            ];
        }

        if (!$patientUser->patient) {
            return [
                'success' => false,
                'message' => 'Este usuário ainda não completou o perfil de paciente.'
            ];
        }

        if ($patientUser->patient->linked_nutritionist && $patientUser->patient->linked_nutritionist !== $nutritionistUser->nutritionist->id) {
             return [
                'success' => false,
                'message' => 'Este paciente já está vinculado a outro profissional.'
            ];
        }

        if ($patientUser->patient->linked_nutritionist === $nutritionistUser->nutritionist->id) {
            return [
               'success' => false,
               'message' => 'Este paciente já faz parte da sua lista.'
           ];
       }

        $patientUser->patient->update([
            'linked_nutritionist' => $nutritionistUser->nutritionist->id
        ]);

        return [
            'success' => true,
            'patient_name' => $patientUser->name
        ];
    }

    
    public function unlinkPatient(User $nutritionistUser, int $patientId): array
    {
        $patient = Patient::where('user_id', $patientId)
            ->where('linked_nutritionist', $nutritionistUser->nutritionist->id)
            ->first();

        if (!$patient) {
             return [
                'success' => false,
                'message' => 'Paciente não encontrado ou não pertence à sua lista.'
            ];
        }

        $patient->update(['linked_nutritionist' => null]);

        return [
            'success' => true,
            'message' => 'Vínculo removido com sucesso.'
        ];
    }

    public function deactivateAccount(User $user): bool
    {
        if ($user->account_status == StatusEnum::Inactive) {
            return false;
        }

        Patient::where('linked_nutritionist', $user->nutritionist->id)->update(['linked_nutritionist' => null]);

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