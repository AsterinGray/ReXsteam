<?php

use App\Http\Controllers\FriendController;
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

Route::resource('cart', TransactionDetailController::class);
Route::resource('transaction', TransactionHeaderController::class);
Route::resource('friends', FriendController::class);
Route::get('/receipt/{transactionId}', [TransactionHeaderController::class, 'receipt'])->name('receipt');
Route::get('/history', [TransactionHeaderController::class, 'show'])->name('history');
