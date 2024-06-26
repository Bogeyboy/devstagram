<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ComentarioController;

Route::get('/', HomeController::class)->middleware('auth')->name('home');


Route::get('/register', [RegisterController::class,'index'])->name('register');
Route::post('/register', [RegisterController::class,'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);//NO SE LE PONE NOMBRE A LA RUTA POR QUE TOMA EL MISMO NOMBRE ANTERIOR
Route::post('/logout', [LogoutController::class,'store'])->name('logout');

//Rutas para el perfil
Route::get('/editar-perfil', [PerfilController::class, 'index'])->middleware('auth')->name('perfil.index');
Route::post('/editar-perfil', [PerfilController::class, 'store'])->middleware('auth')->name('perfil.store');

//Rutas para los post
/* Route::get('/muro',[PostController::class,'index'])->middleware('auth')->name('posts.index'); */
Route::get('/{user:username}', [PostController::class, 'index'])/* ->middleware('auth') */->name('posts.index');
Route::get('/posts/create',[PostController::class,'create'])->middleware('auth')->name('posts.create');
Route::post('posts/',[PostController::class,'store'])->name('posts.store');
Route::get('/{user:username}/posts/{post:id}', [PostController::class, 'show'])->name('posts.show');
Route::delete('/posts/{post}',[PostController::class, 'destroy'])->name('posts.destroy');

Route::post('/{user:username}/posts/{post:id}', [ComentarioController::class, 'store'])->name('comentarios.store');

Route::post('/imagenes',[ImagenController::class,'store'])->name('imagenes.store');

//Like a las fotos
Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('posts.likes.store');
Route::delete('/posts/{post}/likes', [LikeController::class, 'destroy'])->name('posts.likes.destroy');

//Rutas para el perfil
/* Route::get('{user:username}/editar-perfil',[PerfilController::class,'index'])->middleware('auth')->name('perfil.index');
Route::post('{user:username}/editar-perfil', [PerfilController::class, 'store'])->middleware('auth')->name('perfil.store'); */

//Siguiendo a usuarios

Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('users.follow');
Route::delete('/{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('users.unfollow');