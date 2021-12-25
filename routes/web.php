<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginAction'])->name('login.action');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerAction'])->name('register.action');

Route::middleware('auth')->group(function() {
    Route::view('/', 'index')->name('index');
    
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::patch('/profile', [UserController::class, 'update'])->name('profile.update');

    Route::view('/check-age', 'user.checkage')->name('checkAge');
    Route::patch('/check-age', [UserController::class, 'checkAge'])->name('checkAge.action');
    Route::post('/check-age', [UserController::class, 'cancelCheckAge'])->name('checkAge.cancel');

    Route::middleware('checkage')->group(function() {    
        Route::view('/game-detail', 'game.index')->name('game.index');
    });
});

