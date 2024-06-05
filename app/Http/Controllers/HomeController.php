<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /* public function index()
    {
        //return view('home');
        dd('Home');
    } */
    public function __invoke()
    {
        //Obtenemos a quienes seguimos
        $ids = auth()->user()->followings->pluck('id')->toArray();//pluck() únicamente trae de la BD ciertos campos
        $posts = Post::whereIn('user_id',$ids)->paginate(20);

        return view('home',[
            'posts' => $posts
        ]);
    }
}
