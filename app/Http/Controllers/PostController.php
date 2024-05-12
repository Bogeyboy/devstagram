<?php

namespace App\Http\Controllers;

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
        /* return [
            new middleware(middleware:'auth:sanctum',except:['index','show']),
        ]; */
        return [
            'auth',
        ];
    }
    
    public function index()
    {
        return view('dashboard');
    }
}
