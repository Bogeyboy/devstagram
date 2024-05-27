<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comentario;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function store(Request $request, User $user, Post $post)
    {
        //Validando el post
        $request->validate([
            'comentario' => 'required|max:255',
        ]);
        //Almacenando el post
        Comentario::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'comentario' => $request->comentario,
        ]);
        //Imprimir mensaje de éxito
        return back()->with('mensaje','Comentario realizado correctamente');
    }
}
