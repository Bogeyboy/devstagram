<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    public function user()//Relación inversa N:1 con posts
    {
        /* return $this->belongsTo(User::class); */
        return $this->belongsTo(User::class)->select(['name','username']); //El select se usa para elegir los campos a mostrar en la consulta
                                                                        //si no se coloca traerá todos los campos de la tabla elegida
    }
}
