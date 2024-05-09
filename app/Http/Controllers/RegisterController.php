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
        /* $this->validate($request,[
            'name'=>'required'
        ]); */
        $request->validate([
            'name' => 'required|min:5'
        ]);
    }
}
