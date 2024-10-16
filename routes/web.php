<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\ProfileController;

Route::group(['middleware' => 'guest'], function(){
   Route::get('/register', [AuthController::class, 'register'])->name('register');
   Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
   Route::get('/login', [AuthController::class, 'login'])->name('login');
   Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
});

// Protecting Routes
// Only authenticated users may access this route...
Route::group(['middleware' => 'auth'], function(){
    Route::get('/', function () {
        return view('home');
    })->name('home');
   
   Route::get('/home', [HomeController::class, 'index']);
   Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
   Route::resource('/profiles', ProfileController::class);

});
