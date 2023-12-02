<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ZidAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('auth/zid', [ZidAuthController::class, 'redirectToZid'])->name('auth.redirect.zid');
Route::get('auth/zid/callback', [ZidAuthController::class, 'callbackFromZid'])->name('auth.callback.zid');
