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
        return view('home');
    }
}
