<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

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

Route::get('/', function () {
    return view('login');
})->name('login');
   
Route::get('/login/google', [LoginController::class, 'redirectToGoogle']);
Route::get('/login/google/callback', [LoginController::class, 'handleGoogleCallback']);

Route::get('/login/facebook', [LoginController::class, 'redirectToFacebook']);
Route::get('/login/facebook/callback', [LoginController::class, 'handleFacebookCallback']); // error hander for refresh or direct access
 
Route::middleware('auth')->group(function () {
    Route::get('/complete-profile', [LoginController::class, 'completeProfile'])->name('complete-profile'); 
    Route::post('/save-profile', [LoginController::class, 'saveProfile'])->name('save-profile');
});