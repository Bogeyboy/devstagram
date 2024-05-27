<?php

namespace App\Models;

use App\Models\Comentario;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }
}
