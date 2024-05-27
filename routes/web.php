<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Models\Post;
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
Route::post('posts/',[PostController::class,'store'])->name('posts.store');
Route::get('/{user:username}/posts/{post:titulo}', [PostController::class, 'show'])->name('posts.show');

Route::post('/{user:username}/posts/{post:titulo}', [ComentarioController::class, 'store'])->name('comentarios.store');



Route::post('/imagenes',[ImagenController::class,'store'])->name('imagenes.store');