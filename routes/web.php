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

Route::controller(LoginController::class)->group(function (){
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
});

Route::controller(NutritionistController::class)->prefix('nutritionist')->group(function () {
    Route::get('/dashboard', 'redirectMyPatients')->name('nutritionist.my-patients');
});
