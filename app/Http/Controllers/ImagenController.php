<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class ImagenController extends Controller
{
    public function store(Request $request)
    {
        /* $input = $request->all(); */
        $imagen = $request->file('file');
        return response()->json(['imagen'=>$imagen->extension()]);
    }
}