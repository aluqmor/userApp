<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Route::get('/', function () {
//     return view('welcome');
// });

// Rutas de autenticación y verificación de correo electrónico
Auth::routes(['verify' => true]);

// Ruta de la página principal
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

// Rutas para diferentes roles de usuario
Route::get('admin', [App\Http\Controllers\AdministratorController::class, 'index'])->name('admin.index');
Route::get('super', [App\Http\Controllers\AdministratorController::class, 'indexSuper'])->name('super.index');
Route::get('guest', [App\Http\Controllers\HomeController::class, 'guest'])->name('guest');

// Ruta para la página de inicio del usuario autenticado
Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');

// Ruta para la página de verificación de correo electrónico
Route::get('/verificado', [App\Http\Controllers\HomeController::class, 'verificado'])->middleware(['auth', 'verified'])->name('verificado');

// Rutas relacionadas con el perfil del usuario
Route::put('home/password', [App\Http\Controllers\ProfileController::class, 'password'])->name('home.password');
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'show'])->middleware('auth')->name('profile.show');
Route::post('/profile/change-password', [App\Http\Controllers\ProfileController::class, 'changePassword'])->middleware('auth')->name('profile.changePassword');
Route::post('/profile/change-email', [App\Http\Controllers\ProfileController::class, 'changeEmail'])->middleware('auth')->name('profile.changeEmail');
Route::post('/profile/change-username', [App\Http\Controllers\ProfileController::class, 'changeUsername'])->middleware('auth')->name('profile.changeUsername');
Route::delete('/profile/delete', [App\Http\Controllers\ProfileController::class, 'delete'])->middleware('auth')->name('profile.delete');
Route::put('home/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('home.update');

// Rutas relacionadas con la administración de usuarios
Route::get('/admin/users', [App\Http\Controllers\AdministratorController::class, 'index'])->middleware(['auth', 'admin'])->name('admin.users');
Route::get('/admin/users/create', [App\Http\Controllers\AdministratorController::class, 'create'])->middleware(['auth', 'admin'])->name('admin.users.create');
Route::post('/admin/users', [App\Http\Controllers\AdministratorController::class, 'store'])->middleware(['auth', 'admin'])->name('admin.users.store');
Route::get('/admin/users/{user}/edit', [App\Http\Controllers\AdministratorController::class, 'edit'])->middleware(['auth', 'admin'])->name('admin.users.edit');
Route::put('/admin/users/{user}', [App\Http\Controllers\AdministratorController::class, 'update'])->middleware(['auth', 'admin'])->name('admin.users.update');
Route::post('/admin/users/{user}/verify', [App\Http\Controllers\AdministratorController::class, 'verify'])->middleware(['auth', 'admin'])->name('admin.users.verify');
Route::delete('/admin/users/{user}', [App\Http\Controllers\AdministratorController::class, 'delete'])->middleware(['auth', 'admin'])->name('admin.users.delete');
