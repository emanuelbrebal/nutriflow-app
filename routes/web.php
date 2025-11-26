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
    Route::get('/sign-in', 'redirectLogin')->name('login.redirect');
    Route::post('/login-post', 'login')->name('login.post');
    Route::get('/sign-up', 'redirectRegister')->name('register.redirect');
    Route::post('/register-post', 'register')->name('register.post');
});

Route::middleware(AuthUserMiddleware::class)->group(function () {
    Route::post('/logout-post', [LoginController::class, 'logout'])->name('logout');

    Route::controller(UserController::class)->group(function () {
        Route::get('/my-profile', 'redirectMyProfile')->name('user.my-profile');
        Route::post('/user/update', 'update')->name('user.update.post');
    });

    Route::middleware(AuthPatientMiddleware::class)->prefix('patient')->group(function () {
        Route::controller(PatientController::class)->group(function () {
            
            Route::get('/onboarding-form', 'redirectOnboardingForm')->name('user.onboarding-form');
            Route::post('/onboarding-form', 'fillOnboardingForm')->name('user.onboarding-form.post');
            Route::post('/link-nutritionist', 'linkNutritionist')->name('user.link-nutritionist.post');
            Route::post('/unlink-nutritionist', 'unlinkNutritionist')->name('user.unlink-nutritionist.post');

            Route::middleware(OnboardingMiddleware::class)->group(function () {
                Route::get('/dashboard', 'redirectMyDashboard')->name('user.my-dashboard');
                Route::post('/user/delete', 'deleteMyAccount')->name('user.delete.post');

                Route::middleware(UnlinkedPatientMiddleware::class)->group(function () {
                    Route::get('/my-meals', 'redirectMyMeals')->name('user.my-meals');
                });

                Route::middleware(IntermediatePlanMiddleware::class)->group(function () {
                    Route::get('/progresses', 'redirectProgresses')->name('user.progresses');
                });

                Route::middleware(PremiumPlanMiddleware::class)->group(function () {
                    Route::get('/analysis', 'redirectAnalysis')->name('user.analysis');
                });
            });
        });
    });

    Route::middleware(AuthNutritionistMiddleware::class)->prefix('nutritionist')->group(function () {
        Route::controller(NutritionistController::class)->group(function () {
            
            Route::get('/onboarding-form', 'redirectOnboardingForm')->name('nutritionist.onboarding-form');
            Route::post('/onboarding-form', 'fillOnboardingForm')->name('nutritionist.onboarding-form.post');

            Route::middleware(OnboardingMiddleware::class)->group(function () {
                Route::get('/my-patients', 'redirectMyPatients')->name('nutritionist.my-patients');
                Route::post('/link-patient', 'linkPatient')->name('nutritionist.link-patient');
                Route::post('/unlink-patient/{patientUserId}', 'unlinkPatient')->name('nutritionist.unlink-patient');

                Route::get('/set-new-evaluation', 'redirectSetNewEvaluation')->name('nutritionist.redirect.set_new_evaluation');
                Route::get('/set-new-dietary-protocol', 'redirectSetNewDietaryProtocol')->name('nutritionist.redirect.diet_builder');
            });
        });
    });
});