<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\NutritionistController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthNutritionistMiddleware;
use App\Http\Middleware\AuthPatientMiddleware;
use App\Http\Middleware\AuthUserMiddleware;
use App\Http\Middleware\IntermediatePlanMiddleware;
use App\Http\Middleware\OnboardingMiddleware;
use App\Http\Middleware\PremiumPlanMiddleware;
use App\Http\Middleware\UnlinkedPatientMiddleware;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// retorna landing page
Route::get('/', function () {
    return Inertia::render('Index');
})->name('ladingpage.redirect');

Route::get('/upgrade-plan', function () {
    return Inertia::render('Upgrade/UpgradePlan');
})->name('plans.upgrade');

Route::get('/upgrade-plan/payment', function () {
    return Inertia::render('Upgrade/PaymentView');
})->name('payment.redirect');

Route::controller(LoginController::class)->group(function () {
    //login
    Route::get('/sign-in', 'redirectLogin')->name('login.redirect');
    Route::post('/login-post', 'login')->name('login.post');
    //register
    Route::get('/sign-up', 'redirectRegister')->name('register.redirect');
    Route::post('/register-post', 'register')->name('register.post');
    //logout
    Route::post('/logout-post', 'logout')->name('logout');
});

Route::controller(UserController::class)->prefix('user')->group(function () {});

Route::middleware(AuthUserMiddleware::class)->group(function () {
    Route::middleware(AuthPatientMiddleware::class)->group(function () {
        Route::controller(PatientController::class)->prefix('patient')->group(function () {

            Route::get('/onboarding-form', 'redirectOnboardingForm')->name('user.onboarding-form');
            Route::post('/onboarding-form', 'fillOnboardingForm')->name('user.onboarding-form.post');
            Route::post('/link-nutritionist', 'linkNutritionist')->name('user.link-nutritionist.post');
            Route::post('/unlink-nutritionist', 'unlinkNutritionist')->name('user.unlink-nutritionist.post');

            Route::middleware(OnboardingMiddleware::class)->group(function () {
                Route::get('/dashboard', 'redirectMyDashboard')->name('user.my-dashboard');

                Route::get('/my-profile', 'redirectMyProfile')->name('user.my-profile');
                Route::post('/user/update', 'updateMyProfile')->name('user.update.post');

                Route::post('/user/delete', 'deleteMyAccount')->name('user.delete.post');


                Route::get('/my-meals', 'redirectMyMeals')->name('user.my-meals')->middleware(UnlinkedPatientMiddleware::class);
                Route::get('/progresses', 'redirectProgresses')->name('user.progresses')->middleware(IntermediatePlanMiddleware::class);
                Route::get('/analysis', 'redirectAnalysis')->name('user.analysis')->middleware(PremiumPlanMiddleware::class);
            });
        });
    });

    Route::middleware(AuthNutritionistMiddleware::class)->group(function () {
        Route::controller(NutritionistController::class)->prefix('nutritionist')->group(function () {
            Route::get('/dashboard', 'redirectMyPatients')->name('nutritionist.my-patients');
            Route::get('/set-new-evaluation', 'redirectSetNewEvaluation')->name('nutritionist.redirect.set_new_evaluation');
            Route::get('/set-new-dietary-protocol', 'redirectSetNewDietaryProtocol')->name('nutritionist.redirect.diet_builder');
        });
    });
});
