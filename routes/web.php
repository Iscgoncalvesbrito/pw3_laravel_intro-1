<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\EventoController;
use App\Models\User;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::view('/landing', 'landing')->name('landing');

Route::get('/admin', [UserController::class, 'index'])->name('admin.dashboard');
Route::get('/usuarios/novo', [UserController::class, 'create'])->name('usuarios.create');
Route::post('/usuarios', [UserController::class, 'store'])->name('usuarios.store');

Route::get('/usuarios/{id}/editar', [UserController::class, 'edit'])->name('usuarios.edit');
Route::put('/usuarios/{id}', [UserController::class, 'update'])->name('usuarios.update');

// Rota de exclusão (DELETE corrigida)
Route::delete('/usuarios/{id}', [UserController::class, 'destroy'])->name('usuarios.destroy');

Route::get('/livros', [LivroController::class, 'index'])->name('livros.index');
Route::post('/livros', [LivroController::class, 'store'])->name('livros.store');

Route::get('/eventos', [EventoController::class, 'index'])->name('eventos.index');
Route::get('/eventos/novo', [EventoController::class, 'create'])->name('eventos.create');
Route::post('/eventos', [EventoController::class, 'store'])->name('eventos.store');

Route::get('/teste-orm', function () {
    User::create([
        'name' => 'Ana Clara Santos',
        'email' => 'ana.santos@escola.sp.gov.br',
        'password' => bcrypt('12345678')
    ]);
    return User::all();
});