<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\TransactionDetailController;
use App\Http\Controllers\TransactionHeaderController;
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
Route::get('/', [GameController::class, 'index'])->name('index');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginAction'])->name('login.action');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerAction'])->name('register.action');


Route::view('/age', 'user.age')->name('age');
Route::patch('/age', [UserController::class, 'checkAge'])->name('age.action');
Route::post('/age', [UserController::class, 'cancelCheckAge'])->name('age.cancel');

Route::middleware('age')->group(function() {
    Route::view('/game/{id}', 'game.index')->name('game.detail');
});

Route::middleware('admin')->group(function() {
    Route::get('/manage-game', [GameController::class, 'showManageGamePage'])->name('manage_game');
});

Route::middleware('auth')->group(function() {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::patch('/profile', [UserController::class, 'update'])->name('profile.update');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('cart', TransactionDetailController::class);
    Route::resource('transaction', TransactionHeaderController::class);
    Route::resource('friends', FriendController::class);
    Route::get('/receipt/{transactionId}', [TransactionHeaderController::class, 'receipt'])->name('receipt');
    Route::get('/history', [TransactionHeaderController::class, 'show'])->name('history');
});
