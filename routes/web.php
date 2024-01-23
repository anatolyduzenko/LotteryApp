<?php

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

use App\Http\Controllers\LotteryController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\WinnersController;

Route::get('/', function () {
    return view('home');
})->middleware(['smarty']);

Route::group(['namespace' =>'App\Http\Controllers', 'middleware' =>['smarty']], function () {
    Auth::routes();
});

Route::get('/lottery', LotteryController::class)
    ->middleware(['auth'])
    ->name('lottery');

Route::get('/member/lottery', function() {
    return view('member.lottery');
})->middleware(['auth', 'role:member', 'smarty'])->name('member.lottery');

Route::get('/member/results', function() {
    return view('member.results');
})->middleware(['auth', 'role:member', 'smarty'])->name('member.results');

Route::get('/admin/dashboard', function() {
    return view('admin.dashboard');
})->middleware(['auth', 'role:admin', 'smarty'])->name('admin.dashboard');

Route::resource('/admin/tickets', TicketsController::class)
->only(['index', 'create', 'store', 'destroy'])
->middleware(['auth', 'role:admin', 'smarty']);

Route::resource('/admin/winners', WinnersController::class)
->only(['index', 'destroy'])
->middleware(['auth', 'role:admin', 'smarty']);

