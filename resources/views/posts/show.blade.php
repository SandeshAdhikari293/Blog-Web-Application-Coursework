@extends('layouts.app')

@section('title', 'Post')

@section('content')
    <p> {{$post->title}} </p>
    <p> {{$post->content}} </p>

    <p> Posted by {{$user->name}}</p>
    
    <p>Comments:</p>    
    @foreach ($comments as $comment)
            <ul> 
                <li> {{ $comment->text }} </li>
                <li> <a href="{{ route('users.show', ['id' => $comment->user_id]) }}"> {{ $comment->user_id }} </li>
            </ul>
    @endforeach

@endsection