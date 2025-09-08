<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\NutritionistController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// retorna landing page
Route::get('/', function () {
    return Inertia::render('Index');
});

//
Route::controller(LoginController::class)->group(function (){
    Route::get('/sign-in', 'redirectLogin')->name('redirectLogin');
    Route::get('/sign-up', 'redirectRegister')->name('redirectRegister');

});


Route::controller(UserController::class)->prefix('user')->group(function () {
    Route::get('/dashboard', 'redirectMyDashboard')->name('redirectMyDashboard');
});

Route::controller(NutritionistController::class)->prefix('professional')->group(function () {
    Route::get('/dashboard', 'redirectMyPatients')->name('redirectMyPatients');
});
