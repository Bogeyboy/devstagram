<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
//use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class PostController extends Controller /* implements HasMiddleware */
{
    /* public function __construct()
    {
        $this->middleware('auth')->except(['show','index']);
    } */
    public static function middleware() :array
    {
        return [
            new Middleware('auth',except:['show','index']),
        ];
    }
    
    public function index(User $user)
    {
        //dd($user->id);
        /* $posts = Post::where('user_id', $user->id)->get();//Se obtienen todos los resultados */
        $posts = Post::where('user_id', $user->id)->paginate(20); //Se empieza a paginar cuando sobrepasa la cantidad de 20
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

    public function show(User $user, Post $post )
    {
        return view('posts.show',[
            'post' => $post,
            'user' => $user
        ]);
    }

    public function destroy(Post $post)
    {
        Gate::allows('delete',$post);

        $post->delete();

        //Eliminar la imagen
        $imagen_path = public_path('uploads/' . $post->imagen);
        if(File::exists($imagen_path)){
            unlink($imagen_path);
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
