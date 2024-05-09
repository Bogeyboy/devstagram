<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

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
            'username' => 'required|unique:users|min:3',
            'email' => 'required|unique:users|email|max:80',
            'password' => 'required|confirmed|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'username' => Str::slug($request->username), //CON SLUG CONVIERTE LOS ESPACIOS EN URL
            'email' => $request->email,
            /* 'password' => $request->password, */
            'password' => Hash::make($request->password),
        ]);
        //REDIRECCIONAMOS AL USUARIO

    }
}
