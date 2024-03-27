<?php

use App\Http\Controllers\EventoController;
use App\Http\Controllers\PagosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::resource('evento', EventoController::class)->only(['index', 'create', 'store'])->names([
        'index' => 'evento.index',
        'create' => 'evento.create',
        'store' => 'evento.store',
    ]);

    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/pago', [PagosController::class, 'index'])->name('pago.index');



});

require __DIR__.'/auth.php';
