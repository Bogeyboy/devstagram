<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
//use Illuminate\Routing\Controllers\HasMiddleware;
use illuminate\Routing\Controllers\Middleware;

class PostController extends Controller
{
    /* public function __construct()
    {
        $this->middleware('auth');
    } */
    public static function middleware() :array
    {
        return [
            'auth',
        ];
    }
    
    public function index(User $user)
    {
        //dd($user->username);
        return view('dashboard',[
            'user' => $user,
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required',
        ]);

        /* Pasamos un Array con la información pertinente */
        /* Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id'=> auth()->user()->id
        ]); */

        /* Otra forma de insertar registros */
        $post = new Post;
        $post->titulo = $request->titulo;
        $post->descripcion = $request->descripcion;
        $post->imagen = $request->imagen;
        $post->user_id = auth()->user()->id;

        $post->save();

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
