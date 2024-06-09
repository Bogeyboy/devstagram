<?php

namespace App\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    //public $mensaje = "Hola mundo desde un atributo"; /* La información la mandamos directamente desde aquí */

    public $post; /* La información le viene desde la vista */
    public $isLiked; /* Guardará un booleano que almacenará si se le ha dado like o no a la publicación */
    public $likes;
    
    public function mount($post) /* Es como el constructor de PHP */
    {
        $this->isLiked = $post->checkLike(auth()->user());
        $this->likes = $post->likes->count();
    }
    
    public function like()
    {
        if($this->post->checkLike(auth()->user()))/* Eliminamos like de publicación */
        {
            $this->post
                ->likes()
                /* ->where('post_id', $this->post->id) */
                ->where('user_id', auth()->user()->id)
                ->delete();
            $this->isLiked = false;
            $this->likes--;

            return back();
        }
        else
        {
            $this->post->likes()
                ->create([
                    'user_id' => auth()->user()->id
                ]);
            $this->isLiked = true;
            $this->likes++;
        }
    }
    
    public function render()
    {
        return view('livewire.like-post');
    }
}
