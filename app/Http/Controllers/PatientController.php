<?php

namespace App\Http\Controllers;

use App\Enums\AccountTypeEnum;
use App\Enums\ActivityLevelEnum;
use App\Enums\BiologicalSexEnum;
use App\Enums\NutritionistSpecialtyEnum;
use App\Enums\ObjectivesEnum;
use App\Http\Controllers\LoginController;
use App\Http\Requests\CodeLinkRequest;
use App\Http\Requests\OnboardingFillRequest;
use App\Http\Requests\PatientOnboardingUpdateRequest;
use App\Services\PatientService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PatientController extends Controller
{
    public function __construct(
        private LoginController $loginController,
        private PatientService $patientService
    ) {}

    public function redirectMyDashboard()
    {
        $user = Auth::user();
        $user->load(['patient.activeProtocol.meals']);

        return Inertia::render('User/MyDashboard', [
            'user' => $user
        ]);
    }

    public function redirectOnboardingForm()
    {
        return Inertia::render('User/OnboardingForm', [
            'user' => Auth::user(),
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

    public function linkNutritionist(CodeLinkRequest $request)
    {
        $result = $this->patientService->linkNutritionist(Auth::user(), $request->code);

        if (!$result['success']) {
            if ($result['type'] === 'validation') {
                return back()->withErrors(['code' => $result['message']]);
            }
            return back()->with('error', $result['message']);
        }

        return back()->with('success', "Você foi vinculado ao Dr(a). {$result['nutritionist_name']} com sucesso!");
    }

    public function unlinkNutritionist()
    {
        $user = Auth::user();
        $this->patientService->unlinkNutritionist($user);

        return back()->with('success', "Você não está mais vinculado ao nutricionista. Para continuar usando o sistema, por favor vincule-se a outro nutricionista!");
    }

    public function fillOnboardingForm(OnboardingFillRequest $request)
    {
        $userData = ['mobile_number' => $request->mobile_number];

        $patientData = $request->only([
            'birth_date',
            'biological_sex',
            'height',
            'weight',
            'main_objective',
            'activity_level'
        ]);

        $this->patientService->updateProfile(
            Auth::user(),
            $userData,
            $patientData,
            $request->file('profile_picture'),
            true
        );

        return redirect()->route('user.my-profile')->with('success', 'Perfil atualizado com sucesso!');
    }

    public function updateMyProfile(PatientOnboardingUpdateRequest $request)
    {
        $userData = [
            'name' => $request->name,
            'mobile_number' => $request->mobile_number
        ];

        $patientData = $request->only([
            'birth_date',
            'biological_sex',
            'height',
            'weight',
            'main_objective',
            'activity_level'
        ]);

        $this->patientService->updateProfile(
            Auth::user(),
            $userData,
            $patientData,
            $request->file('profile_picture')
        );

        return back()->with('success', 'Perfil atualizado com sucesso!');
    }

    public function deleteMyAccount(Request $request)
    {
        $success = $this->patientService->deactivateAccount(Auth::user());

        if (!$success) {
            return back()->with(['error', 'Essa conta já está desativada.']);
        }

        $this->loginController->logout($request);

        return back()->with(['error', 'Essa conta já está desativada.']);
    }
}
