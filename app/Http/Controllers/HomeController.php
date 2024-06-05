<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
        dd(auth()->user()->followings->pluck('id')->toArray());//pluck() únicamente trae de la BD ciertos campos
        return view('home');
    }
}
