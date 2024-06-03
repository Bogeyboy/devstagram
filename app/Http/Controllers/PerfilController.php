<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PerfilController extends Controller 
{
    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {
        //MODIFICAMOS EL REQUEST PARA QUE FUNCIONE LA VALIDACIÓN DE LARAVEL
        $request->request->add(['username' => Str::slug($request->username)]); //CON SLUG CONVIERTE LOS ESPACIOS EN URL

        $request->validate([//Validamos el campo username y el email y el nuevo password
            'username' => [
                'required',
                //'unique:users,username' . auth()->user()->id, // Excluye de la comprobación el username de la persona logada
                Rule::unique('users', 'username')->ignore(auth()->user()),// Excluye de la comprobación el username de la persona logada
                'min:3',
                'max:20',
                'not_in:twitter,editar-perfil,editar,perfil,registrar'
            ],
            'email' => [
                'email',
                Rule::unique('users', 'email')->ignore(auth()->user()),//Excluye de la comprobación el email de la persona logada
                'max:100'
            ],
        ]);

        if($request->imagen)//Si en el $request existe una imagen
        {
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
        $usuario->email = $request->email;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? '';

        if(Hash::check($request->oldpassword,auth()->user()->password))//Compruebo que la contraseña antigua introducida es correcta
        {
            $request->validate([
                'newpassword' => [
                    'sometimes',
                    'nullable',
                    'confirmed',
                    'min:6'
                ]
            ]);

            if( empty($request->input('newpassword')) && empty($request->input('newpassword_confirmation')) )//Si están vacías las contraseñas
            {
                //Salvamos los datos del usuario, solo ha cambiado la foto y lo redirigimos a su muro
                $usuario->save();
                return redirect()->route('posts.index', auth()->user()->username);
            }
            else //Si no estan vacías
            {
                //Asignamos nueva contraseña, salvamos al usuario en la BD y redireccionamos al login
                $usuario->password = Hash::make($request->newpassword);
                $usuario->save();
                auth()->logout();
                return redirect()->route('login', auth()->user());

                //Redireccionamos al usuario a su muro
                //return redirect()->route('posts.index', $usuario->username);
            }
        }
        else
        {
            return back()->with('mensaje', 'La contraseña antigua NO es correcta.');
        }
    }
}