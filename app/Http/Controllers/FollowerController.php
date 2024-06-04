<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    //    public function store(User $user, Request $request)//$user es el perfil que se está visitando
    public function store(User $user)
    {
        $user->followers()->attach( auth()->user()->id );/* Usamos attach para hacer las relaciones con la misma tabla */

        return back();//Volvemos a la página anterior
    }

    public function destroy(User $user)
    {
        $user->followers()->detach(auth()->user()->id);/* Usamos detach para deshacer las relaciones con la misma tabla */

        return back();//Volvemos a la página anterior
    }
}
