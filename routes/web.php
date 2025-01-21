<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Auth\ClientAuthController;
use App\Http\Controllers\Auth\RegisterController;
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware('guest:client')->group(function () {
    Route::get('login', [ClientAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [ClientAuthController::class, 'login'])->name('login.submit');
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
});

Route::middleware('auth:client')->group(function () {
    Route::post('logout', [ClientAuthController::class, 'logout'])->name('logout');
    Route::get('dashboard', function () {
        return view('client.dashboard');
    })->name('dashboard');
});

Route::get('/admin', function () {
    return redirect()->route('admin.login');
});
Route::group(['prefix' => 'admin'], function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AuthController::class, 'login'])->name('admin.login.submit');
    Route::post('logout', [AuthController::class, 'logout'])->name('admin.logout');
    
    // Protected admin routes


    Route::group(['middleware' => ['auth', 'is_admin']], function () {
        Route::get('dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        Route::resource('agents', AgentController::class)->names([
            'index' => 'admin.agents.index',
            'create' => 'admin.agents.create',
            'store' => 'admin.agents.store',
            'edit' => 'admin.agents.edit',
            'update' => 'admin.agents.update',
            'destroy' => 'admin.agents.destroy',
        ]);
    });
}); 