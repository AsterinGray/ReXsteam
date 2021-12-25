<?php

use App\Http\Controllers\AuthController;
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
        
    Route::get('/profile', [AuthController::class, 'edit'])->name('profile');
    Route::post('/profile', [AuthController::class, 'update'])->name('profile.update');
});

