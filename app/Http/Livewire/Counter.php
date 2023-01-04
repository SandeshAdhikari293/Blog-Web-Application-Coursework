<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Comment;
use App\Notifications\NewComment;


class Counter extends Component
{
    public $input;
    public $post;
    public $page = 1;
    public $comment_per_page = 3;
    public $upvotes;
    public $edit_comment;

    public function post(){
        // dd($this->pid);
        $comment = new Comment;
        $comment->post_id = $this->post->id;
        $comment->text = $this->input;
        $comment->user_id = \Auth::user()->id;

        $comment->save();
        $comment->post->user->notify(new NewComment( \Auth::user(), $comment->post, $comment));

        $this->post = $comment->post;
        $this->page = count($this->post->comments) / $this->comment_per_page;
    }

    public function edit(){

    }

    public function upvote(){
        $this->post->upvotes()->syncWithoutDetaching(\Auth::user()->id);
        $this->post->save();
        $this->upvotes = count($this->post->upvotes);
    }

    public function next_page(){
        $this->page = $this->page + 1;
    }

    public function prev_page(){
        $this->page = $this->page - 1;
    }
    
    public function max_pages(){
        return count($this->post->comments) / $this->comment_per_page;
    }

    public function render()
    {
        return view('livewire.counter');
    }
}
