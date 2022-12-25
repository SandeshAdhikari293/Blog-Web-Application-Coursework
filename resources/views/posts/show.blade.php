@extends('layouts.app')

@section('title', 'Post')

@section('content')


    <form  method="GET" action="{{ route('posts.index') }}">
        @csrf
        <button>Go back</button>
    </form>

    <h2> {{$post->title}} </h2>
    @if($post->image != "")

        <img src="{{ url('image/'. $post->image) }}" alt="unavailable"/>
        
    @endif
    <p> {{$post->content}} </p>

    <p> Posted by {{$user->name}}</p>
    <br>
    <p>Comments:</p>    
    @foreach ($comments as $comment)
            <br>
            <ul> 
                <div style="width:500px;height:100px;border:1px solid #000;">
                    <li> {{ $comment->text }} </li>
                    <br><br>
                    <li> Comment by <a href="{{ route('users.show', ['id' => $comment->user_id]) }}"> {{ $comment->user->name }} </a> </li>
            

                    @if(auth()->user()->is_admin || auth()->user()->id == $user->id)
                        <form method="DELETE" action="{{ route('comments.destroy', ['p_id' => $post->id, 'c_id' => $comment->id]) }}">
                            @csrf                
                            <input type="submit" value="Delete comment">
                        </form>
                    @endif

                </div>
            </ul>
    @endforeach
    <br><br><br>

    @if(auth()->user()->is_admin || auth()->user()->id == $user->id)

        <form method="DELETE" action="{{ route('posts.destroy', ['id' => $post->id]) }}">
            @csrf            
            <input type="submit" value="Delete post">
        </form>
    @else
        <p>not Admin log in</p>
    @endif

    <br><br><br>
    @if ($errors->any())
        <div>
            Errors:
            <ul>
                @foreach ($errors->all() as $error)
                    <li> {{$error}} </li>
                @endforeach
            </ul>
        </div>
    @endif

    <div>
        <form method="POST" action="{{ route('comments.store', ['id' => $post->id]) }}">
            @csrf
            <p>Comment: <input type="text" name="comment" value = "{{ old('comment') }}"></p>
            
            <input type="submit" value="Submit">
            <a href=" {{ route('posts.index') }}">Cancel</a>
        </form>
    </div>

@endsection