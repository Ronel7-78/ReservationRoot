<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgenceController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TrajetController;
use App\Http\Controllers\VoyageController;
use Illuminate\Support\Facades\Route;

// Route publique
Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', [AdminController::class, 'index'])->name('home');

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
        Route::prefix('BusModule')->group(function() {
            Route::resource('bus', BusController::class)->parameters(['bus' => 'bus'])->except(['show'])->names([
                'index' => 'Agence.Bus.index',
                'create' => 'Agence.Bus.create',
                'store' => 'Agence.Bus.store',
                'edit' => 'Agence.Bus.Editer',
                'update' => 'Agence.Bus.Update',
                'destroy' => 'Agence.Bus.supprimer'
            ]);
        });
        Route::resource('trajets', TrajetController::class)->except(['show'])->names([
            'index' => 'Agence.Trajets.index',
            'create' => 'Agence.Trajet.create',
            'store' => 'Agence.Trajet.store',
            'edit' => 'Agence.Trajet.edit',
            'update'=> 'Agence.Trajet.update',
            'destroy' => 'Agence.Trajet.supprimer'
        ]);
        Route::resource('voyages', VoyageController::class)->except(['show'])->names([
            'index' => 'Agence.Voyages.index',
            'create' => 'Agence.Voyage.create',
            'store' => 'Agence.Voyage.store',
            'destroy' => 'Agence.Voyage.supprimer',
            'edit' => 'Agence.Voyage.Edit',
            'update' => 'Agence.Voyage.Update'
        ]);
        Route::get('check-bus-disponibilite', [BusController::class, 'checkDisponibilite']);
    });
});

Route::middleware(['auth', 'role:client'])->group(function () {
    Route::prefix('Client')->group(function () {
        Route::get('/home', [ClientController::class, 'index'])->name('Client.home');
        Route::get('/create', [ReservationController::class, 'create'])->name('reservations.create');
        Route::post('/store', [ReservationController::class, 'store'])->name('reservations.store');
        Route::get('/{reservation}/show', [ReservationController::class, 'show'])->name('reservations.show');
    });
});
Route::middleware(['auth', 'role:client'])->prefix('Client')->group(function () {
    Route::get('/voyages/{voyage}/sieges', [VoyageController::class, 'sieges']);
});

