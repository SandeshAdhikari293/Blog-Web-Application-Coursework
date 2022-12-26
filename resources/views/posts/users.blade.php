@extends('layouts.app')

@section('title', 'User posts')

@section('content')
    @if (session('message'))
        <p><b>{{session('message')}} </b></p>    
    @endif
        <p>Your posts:</p>
        <div>
            @foreach ($user->posts as $post)
                <ul> 
                    <div style="width:500px;height:100px;border:1px solid #000;">
                        <li> <a href="{{ route('posts.show', ['id' => $post->id]) }}"> {{ $post->title }} </a> </li>
                    </div>
                </ul>
            @endforeach
        </div>
        <br> <br>
        <p>Your Comments:</p>
        <div>
            @foreach ($user->comments as $comment)
                <ul> 
                    <div style="width:500px;height:100px;border:1px solid #000;">
                        <li> <a href="{{ route('posts.show', ['id' => $comment->post->id]) }}"> {{ $post->title }} </a> </li>
                        <br>
                        <p> {{$comment->text}}</p>
                    </div>
                </ul>
            @endforeach
        </div>

@endsection