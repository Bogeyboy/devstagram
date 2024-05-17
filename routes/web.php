<?php

use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('principal');
});

Route::get('/register', [RegisterController::class,'index'])->name('register');
Route::post('/register', [RegisterController::class,'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);//NO SE LE PONE NOMBRE A LA RUTA POR QUE TOMA EL MISMO NOMBRE ANTERIOR
Route::post('/logout', [LogoutController::class,'store'])->name('logout');


/* Route::get('/muro',[PostController::class,'index'])->middleware('auth')->name('posts.index'); */
Route::get('/{user:username}', [PostController::class, 'index'])->middleware('auth')->name('posts.index');
Route::get('/posts/create',[PostController::class,'create'])->middleware('auth')->name('posts.create');

Route::post('/imagenes',[ImagenController::class,'store'])->name('imagenes.store');