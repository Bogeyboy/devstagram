<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class PerfilController extends Controller 
{
    /* public function __construct()
    {
        $this->middleware('auth');
    } */
    
    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {
        //MODIFICAMOS EL REQUEST PARA QUE FUNCIONE LA VALIDACIÓN DE LARAVEL
        $request->request->add(['username' => Str::slug($request->username)]); //CON SLUG CONVIERTE LOS ESPACIOS EN URL

        /* $request->validate([
            'username' => ['required',
                            'unique:users,username'.auth()->user()->id,// Excluye de la comprobación el username de la persona logada
                            'min:3',
                            'max:20'],
                            'not_in:twitter,editar-perfil'
        ]); */

        $request->validate([
            'username' => [
                'required',
                //'unique:users,username' . auth()->user()->id, // Excluye de la comprobación el username de la persona logada
                Rule::unique('users', 'username')->ignore(auth()->user()),// Excluye de la comprobación el username de la persona logada
                'min:3',
                'max:20',
                'not_in:twitter,editar-perfil'
            ],
        ]);
    }
}
