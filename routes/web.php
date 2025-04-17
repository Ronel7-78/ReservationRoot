<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgenceController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route ;

// Route publique
Route::get('/', function () {
    return view('welcome');
});
Route::get('/home',[AdminController::class, 'index'])->name('home');
// Authentification
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
    

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
});

// Déconnexion
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboards
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::prefix('Admin')->group(function () {

        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('Admin.dashboard');
        Route::get('/register', [AdminController::class, 'create'])->name('Admin.register');
        Route::post('/register', [AdminController::class, 'store'])->name('Admin.store');
        Route::get('/agences/create', [AdminController::class, 'createAgence'])->name('admin.agences.create');
        Route::post('/agences', [AdminController::class, 'storeAgence'])->name('admin.agences.store');
    });

});

Route::middleware(['auth', 'role:agence'])->group(function () {
    Route::prefix('Agence')->group(function () { 
        Route::get('/dashboard', [AgenceController::class, 'index'])->name('Agence.dashboard');
        Route::resource('agence/bus', BusController::class)->except(['show']);
        Route::post('check-bus-disponibilite', [BusController::class, 'checkDisponibilite']);
        Route::get('/bus/create',[BusController::class, 'create'])->name('Agence.Bus.create');
        Route::post('/bus/store',[BusController::class, 'store'])->name('Agence.Bus.store');
    });
    
});

Route::middleware(['auth', 'role:client'])->group(function () {
    Route::prefix('Client')->group(function () { 
        Route::get('/home', [ClientController::class, 'index'])->name('Client.home');
    });
    

});