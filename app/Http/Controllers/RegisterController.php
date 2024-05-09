<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }
    public function store(Request $request)
    {
        //dd($request);
        //dd($request->get('username'));

        //VALIDACION
        $request->validate([
            'name' => 'required|max:30',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|email|max:80',
            'password' => 'required|confirmed|min:6'
        ]);

        dd('Creando usuario......');
    }
}
