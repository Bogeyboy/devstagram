<?php

namespace App\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    //public $mensaje = "Hola mundo desde un atributo"; /* La información la mandamos directamente desde aquí */

    public $post; /* La información le viene desde la vista */
    
    public function like()
    {
        if($this->post->checkLike(auth()->user()))/* Eliminamos like de publicación */
        {
            $this->post
                ->likes()
                ->where('post_id', $this->post->id)
                ->delete();

            return back();
        }
        else
        {
            $this->post->likes()
                ->create([
                    'user_id' => auth()->user()->id
                ]);
        }
    }
    
    public function render()
    {
        return view('livewire.like-post');
    }
}
