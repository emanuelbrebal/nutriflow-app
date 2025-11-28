<?php

namespace App\Http\Controllers;

use App\Enums\ActivityLevelEnum;
use App\Enums\BiologicalSexEnum;
use App\Enums\ObjectivesEnum;
use App\Http\Controllers\LoginController;
use App\Http\Requests\CodeLinkRequest;
use App\Http\Requests\OnboardingFillRequest;
use App\Http\Requests\PatientOnboardingUpdateRequest;
use App\Services\PatientService;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class PatientController extends Controller
{
    public function __construct(
        private LoginController $loginController,
        private PatientService $patientService,
        private UserService $userService
    ) {}

    public function redirectMyDashboard()
    {
        $user = $this->userService->getAuthUser();
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
        try {
            DB::beginTransaction();
            $user = $this->userService->getAuthUser();
            $result = $this->patientService->linkNutritionist($user, $request->code);
            DB::commit();
            return back()->with('success', "Você foi vinculado ao Dr(a). {$result['nutritionist_name']} com sucesso!");
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Erro ao vincular nutricionista. Por favor, verifique o código ou tente novamente.');
        }
    }

    public function unlinkNutritionist()
    {
        try {
            DB::beginTransaction();
            $user = $this->userService->getAuthUser();
            $this->patientService->unlinkNutritionist($user);
            DB::commit();
            return back()->with('success', "Você não está mais vinculado ao nutricionista. Para continuar usando o sistema, por favor vincule-se a outro nutricionista!");
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Erro ao desvincular um nutricionista');
        }
    }

    public function fillOnboardingForm(PatientOnboardingUpdateRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = $this->userService->getAuthUser();
            $this->patientService->updateProfile($user, $request);
            DB::commit();
            return redirect()->route('user.my-profile')->with('success', 'Perfil atualizado com sucesso!');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Erro ao preencher formulário onboarding');
        }
    }

    public function updateMyProfile(PatientOnboardingUpdateRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = $this->userService->getAuthUser();
            $this->patientService->updateProfile($user, $request);
            DB::commit();
            return redirect()->route('user.my-profile')->with('success', 'Perfil atualizado com sucesso!');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Erro ao atualizar o perfil');
        }
    }

    public function deleteMyAccount(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = $this->userService->getAuthUser();
            $this->patientService->deactivateAccount($user);
            DB::commit();
            return $this->loginController->logout($request);
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with(['error', 'Essa conta já está desativada.']);
        }
    }
}
