<?php

namespace App\Livewire;

use Livewire\Component;

class LikePost extends Component {
    public $post;
    public $isLiked;

    public $likes;

    //Equivalente a un constructor de php pero se llama mount
    public function mount($post) {
        //Retornar cierto o falso si ya dio o no like el usuario en un post
        $this->isLiked = $post->checkLike(auth()->user());
        //Retornar cuantos likes tiene el post
        $this -> likes = $post ->likes -> count();
    }

    public function like() {
            //En caso de que no le haya dado me gusta
        if($this->post->checkLike(auth()->user())) {
            //Nos traemos el usuario, despues los like y depues la condicion
            $this->post->likes()->where('post_id', $this->post->id)->delete();
            //Se asigna falso si no emos dado like anteriormente
            $this -> isLiked = false;
            //Restamos si da un dislike
            $this -> likes --;
        } else {
            $this->post->likes()->create([
                'user_id' => auth()->user()->id
            ]);
            //Asignar el valor a cierto si ya habia dado like anteriormente
            $this -> isLiked = true;
            //Sumamos si da un like
            $this -> likes ++;

        }
    }

    public function render() {
        return view('livewire.like-post');
    }
}
