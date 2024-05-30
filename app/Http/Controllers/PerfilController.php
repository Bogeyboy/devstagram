<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\User;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

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

        $request->validate([//Validamos el campo username
            'username' => [
                'required',
                //'unique:users,username' . auth()->user()->id, // Excluye de la comprobación el username de la persona logada
                Rule::unique('users', 'username')->ignore(auth()->user()),// Excluye de la comprobación el username de la persona logada
                'min:3',
                'max:20',
                'not_in:twitter,editar-perfil'
            ],
        ]);

        if($request->imagen){
            $manager = new ImageManager(new Driver());

            $imagen = $request->file('imagen');
            $nombreImagen = Str::uuid() . "." . $imagen->extension();

            $imagenServidor = $manager->read($imagen);
            $imagenServidor->scale(1000, 1000);
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);
        }
        //Guardar cambios
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? '';
        $usuario->save();

        //Redireccionamos al usuario
        return redirect()->route('posts.index', $usuario->username);
    }
}