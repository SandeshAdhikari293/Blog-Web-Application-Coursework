@extends('layouts.app')

@section('title', 'User Details')

@section('content')
    <p> {{$user->name}} </p>
    <p> {{$user->email}} </p>
    <br>
    @if(auth()->user()->is_admin || auth()->user()->id == $user->id)

    <form method="DELETE" action="{{ route('users.destroy', ['id' => $user->id]) }}">
        @csrf            
        <input type="submit" value="Delete User">
    </form>
    @endif
    <br>
    <p>Posts</p>
    <div>      
        @foreach ($user->posts as $post)
            <ul>
                <li> <a href="{{ route('posts.show', ['id' => $post->id]) }}"> {{ $post->title }} </a> </li> 
            </ul>
        @endforeach

    </div>
    <br>
    <p>Comments</p>
    <div>
        @foreach ($user->comments as $comment)
            <ul>
                <li> <a href="{{ route('posts.show', ['id' => $comment->post->id]) }}"> {{ $comment->post->title }} : {{$comment->text}} </a> </li> 
            </ul>
        @endforeach
    </div>
    <br><br>


@endsection