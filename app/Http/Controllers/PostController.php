<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page)
    {
        $posts = Post::all();
        return view('posts.index', ['posts' => $posts, 'page' => $page]);        
    }
    
    public function create()
    {
        return view('posts.create');        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate the data
        $validatedData = $request->validate([
            'title' => 'required|max:16',
            'content' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        //Create a new post and store attributes in object
        $post = new Post;
        $post->title = $validatedData['title'];
        $post->content = $validatedData['content'];
        $post->user_id = \Auth::user()->id;

        //Check if user uplaoded image
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            //Store image
            $request->image->move(public_path('image'), $filename);

            $post->save();

            //Create polymorphic relation to the image
            $post->image()->create(['imageable_id' => $post->id, 'url' => $filename]);
        };

        $post->save();

        session()->flash('message', 'Post was created');

        return redirect()->route('posts.index', ['page' => 1]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $page)
    {
        $post = Post::findOrFail($id);
        $user = User::findOrFail($post->user_id);
        $comments = $post->comments;

        return view('posts.show', ['post' => $post, 'user' => $user, 'comments' => $comments, 'page' => $page]);
    }

    public function user($id)
    {
        $user = User::findOrFail($id);

        return view('posts.users', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', ['post' => $post]);       
    }

        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        //Validate the data
        $validatedData = $request->validate([
            'title' => 'required|max:16',
            'content' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        //Store validated attributes into post object
        $post->title = $validatedData['title'];
        $post->content = $validatedData['content'] . " \n[edited]";
        // $post->user_id = \Auth::user()->id;

        //Check if the user uploaded an image
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            //Store the image
            $request->image->move(public_path('image'), $filename);

            //Add a polymorphic relation for the image
            $post->image()->create(['imageable_id' => $post->id, 'url' => $filename]);

        };

        $post->update();

        session()->flash('message', 'Post was edited');

        return redirect()->route('posts.show', ['id' => $id, 'page' => 1]);        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('posts.index', ['page' => 1])->with('message', 'Post was deleted!');
    }
}
