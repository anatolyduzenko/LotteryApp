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
    return view('welcome');
});

Auth::routes();


Route::get('/member/lottery', function() {
    return view('member.lottery');
})->middleware(['auth', 'role:member'])->name('member.lottery');

Route::get('/member/results', function() {
    return view('member.results');
})->middleware(['auth', 'role:member'])->name('member.results');

Route::get('/admin/dashboard', function() {
    return view('admin.lottery');
})->middleware(['auth', 'role:admin'])->name('admin.dashboard');

// Route::get('/admin/lottery', LotteryController::class)->middleware(['auth', 'role:admin'])->name('admin.lottery');
