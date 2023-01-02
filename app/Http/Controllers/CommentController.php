<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Notifications\NewComment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request, $id)
    // {
        
    //     //dd($request['comment']);
    //     $validatedData = $request->validate([
    //         'comment' => 'required|max:255',
    //     ]);

    //     $comment = new Comment;
    //     $comment->post_id = $id;
    //     $comment->text = $validatedData['comment'];
    //     $comment->user_id = \Auth::user()->id;

    //     $comment->save();
    //     $comment->post->user->notify(new NewComment( \Auth::user(), $comment->post, $comment));

    //     session()->flash('message', 'Comment was created');


    //     // return redirect()->route('posts.show', ['id' => $id, 'page' => 1]);
    //     return response()->json(['success' => 'Post created successfully.']);
    // }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'comment' => 'required|max:255'
        ]);
  
        if ($validator->fails()) {
            return response()->json([
                        'error' => $validator->errors()->all()
                    ]);
        }
       
        // $comment = new Comment;
        // $comment->post_id = $id;
        // $comment->text = $request->comment;
        // $comment->user_id = \Auth::user()->id;

        // $comment->save();
        // $comment->post->user->notify(new NewComment( \Auth::user(), $comment->post, $comment));
  
        return response()->json(['success' => 'Product created successfully.']);
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($p_id, $c_id)
    {
        $comment = Comment::findOrFail($c_id);
        $comment->delete();

        return redirect()->route('posts.show', ['id' => $p_id, 'page' => 1])->with('message', 'Post was deleted!');
    }
}
