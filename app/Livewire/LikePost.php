<?php

namespace App\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    //public $mensaje = "Hola mundo desde un atributo"; /* La información la mandamos directamente desde aquí */

    public $post; /* La información le viene desde la vista */
    
    public function like()
    {
        return "Retornando desde la función like";
    }
    
    public function render()
    {
        return view('livewire.like-post');
    }
}
