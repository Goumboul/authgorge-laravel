<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'Welcome bro';
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', function () {
        return 'Bienvenue, tu es bien connecté en tant que admin';
    })->name('admin.dashboard');
});

Route::middleware(['auth', 'role:moderator'])->group(function () {
    Route::get('/moderation', function () {
        return 'Espace pour les modos';
    })->name('moderation.dashboard');
});

require __DIR__.'/auth.php';
