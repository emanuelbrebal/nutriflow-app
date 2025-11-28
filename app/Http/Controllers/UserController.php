<?php

namespace App\Http\Controllers;

use App\Enums\AccountTypeEnum;
use App\Enums\ActivityLevelEnum;
use App\Enums\BiologicalSexEnum;
use App\Enums\NutritionistSpecialtyEnum;
use App\Enums\ObjectivesEnum;
use App\Http\Requests\ChangePasswordRequest;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class UserController extends Controller
{
    public function __construct(private UserService $userService, private LoginController $loginController) {}
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

    public function changePassword(ChangePasswordRequest $request)
    {
        try {
            DB::beginTransaction();
            $password = $request->only('password');

            $changed = $this->userService->changePassword($password);
            DB::commit();
            if ($changed) {
                return redirect()->back()->with(['success' => 'Senha alterada com suceso!']);
            }
            return redirect()->back()->with(['error' => 'Digite uma senha diferente para alterar']);
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Erro ao tentar alterar a senha');
        }
    }

    public function deleteAccount(Request $request)
    {
        try {
            DB::beginTransaction();
            $deleted = $this->userService->deleteAccount();
            DB::commit();
            if ($deleted) {
                $this->loginController->logout($request);
            }
            return redirect()->back()->with('error', 'Algo deu errado ao desativar a conta');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Algo deu errado ao tentar desativar a conta');
        }
    }
}
