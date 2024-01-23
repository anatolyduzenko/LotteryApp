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

Route::get('/', function () {
    return view('home');
})->middleware(['smarty']);

Route::namespace('App\Http\Controllers')->group(function () {
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


