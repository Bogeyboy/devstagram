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
        //dd($user->id);
        $posts = Post::where('user_id', $user->id)->get();
        return view('dashboard',[
            'user' => $user,
            'posts' => $posts
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

        /* Otra forma de insertar registros 
        $post = new Post;
        $post->titulo = $request->titulo;
        $post->descripcion = $request->descripcion;
        $post->imagen = $request->imagen;
        $post->user_id = auth()->user()->id;

        $post->save();*/

        //Tercera forma de crear registros usando las relaciones entre las dos tablas
        $request->user()->posts()->create([ //se pone posts() por que con los paréntesis se accede a la funcionlidad del método
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            /* 'user_id' => auth()->user()->id */
        ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
