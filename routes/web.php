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

Route::get('/member/lottery', [TicketsController::class, 'index'])
    ->middleware(['auth', 'role:member', 'smarty'])
    ->name('member.lottery');

Route::post('/member/placeticket',[TicketsController::class, 'placetickets'])
    ->middleware(['auth', 'role:member', 'smarty'])
    ->name('member.placeticket');

Route::get('/member/winners',[WinnersController::class, 'winners'])
    ->middleware(['auth', 'role:member', 'smarty'])
    ->name('member.winners');

Route::resource('/member/results', WinnersController::class)
    ->only(['index'])
    ->middleware(['auth', 'role:member', 'smarty']);

Route::get('/admin/dashboard', function() {
    return view('admin.dashboard');
})->middleware(['auth', 'role:admin', 'smarty'])->name('admin.dashboard');

Route::resource('/admin/tickets', TicketsController::class)
    ->only(['index', 'destroy'])
    ->middleware(['auth', 'role:admin', 'smarty']);

Route::resource('/admin/winners', WinnersController::class)
    ->only(['index', 'destroy'])
    ->middleware(['auth', 'role:admin', 'smarty']);

