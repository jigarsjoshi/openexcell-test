<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ClientProjectController;
use App\Http\Controllers\DesignerProjectController;

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
     
    $user = Auth::user();

    if($user) {
        if($user->user_type == 0) {
            return redirect()->route('client.dashboard');
        } else if($user->user_type == 1) {
            return redirect()->route('designer.dashboard');
        }
    } else {
        return view('login');
    } 
    
})->name('login');

Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');

   
Route::get('/login/google', [LoginController::class, 'redirectToGoogle']);
Route::get('/login/google/callback', [LoginController::class, 'handleGoogleCallback']);

Route::get('/login/facebook', [LoginController::class, 'redirectToFacebook']);
Route::get('/login/facebook/callback', [LoginController::class, 'handleFacebookCallback']);

 
Route::middleware('auth')->group(function () {
    Route::get('/complete-profile', [LoginController::class, 'completeProfile'])->name('complete-profile'); 
    Route::post('/save-profile', [LoginController::class, 'saveProfile'])->name('save-profile');

    Route::middleware('role:client')->group(function () {
        Route::get('/client-dashboard', [ClientProjectController::class, 'index'])->name('client.dashboard');
        Route::get('/client-project-create', [ClientProjectController::class, 'create'])->name('client.project.create');
        Route::post('/client-project-save', [ClientProjectController::class, 'store'])->name('client.project.save');
        Route::get('/client-projects/{project}', [ClientProjectController::class, 'show'])->name('client.project.show');
    });
    
    Route::middleware('role:designer')->group(function () {
        Route::get('/designer-dashboard', [DesignerProjectController::class, 'index'])->name('designer.dashboard');
        Route::get('/designer-projects/{project}', [DesignerProjectController::class, 'show'])->name('designer.project.show');
    });
});