<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\NutritionistController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// retorna landing page
Route::get('/nutriflow-welcome', function () {
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


Route::controller(UserController::class)->prefix('user')->group(function () {
    Route::get('/dashboard', 'redirectMyDashboard')->name('user.my-dashboard');
    Route::get('/onboarding-form', 'redirectOnboardingForm')->name('user.onboarding-form');
    Route::get('/my-profile', 'redirectMyProfile')->name('user.my-profile');
});

Route::controller(NutritionistController::class)->prefix('nutritionist')->group(function () {
    Route::get('/dashboard', 'redirectMyPatients')->name('nutritionist.my-patients');
    Route::get('/set-new-evaluation', 'redirectSetNewEvaluation')->name('nutritionist.redirect.set_new_evaluation');
    Route::get('/set-new-dietary-protocol', 'redirectSetNewDietaryProtocol')->name('nutritionist.redirect.diet_builder');
});
