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
        //MODIFICAMOS EL REQUEST PARA QUE FUNCIONE LA VALIDACIÓN DE LARAVEL
        $request->request->add(['username'=> Str::slug($request->username)]);//CON SLUG CONVIERTE LOS ESPACIOS EN URL

        //VALIDACION
        $request->validate([
            'name' => 'required|max:30',
            'username' => 'required|unique:users|min:3',
            'email' => 'required|unique:users|email|max:80',
            'password' => 'required|confirmed|min:6'
        ]);

        User::create([
            'name' => $request->name,
            //'username' => Str::slug($request->username),
            'username' => $request->username, //SE DEJA DE ESTA MANERA POR QUE LA VALIDACIÓN SE HACE ARRIBA
            'email' => $request->email,
            /* 'password' => $request->password, */
            'password' => Hash::make($request->password),
        ]);

        //AUTENTICAR USUARIO
        /* auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ]); */

        //OTRA FORMA DE AUTENTICAR USUARIO
        auth()->attempt($request->only('email','password'));

        //REDIRECCIONAMOS AL USUARIO
        return redirect()->route('posts.index', auth()->user()->username);
    }
}
