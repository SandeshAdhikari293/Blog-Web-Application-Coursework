<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Comment;
use App\Notifications\NewComment;


class Counter extends Component
{
    public $input;
    public $post;


    public function post(){
        // dd($this->pid);
        $comment = new Comment;
        $comment->post_id = $this->post->id;
        $comment->text = $this->input;
        $comment->user_id = \Auth::user()->id;

        $comment->save();
        $comment->post->user->notify(new NewComment( \Auth::user(), $comment->post, $comment));

        $this->post = $comment->post;
    }

    public function render()
    {
        return view('livewire.counter');
    }
}
