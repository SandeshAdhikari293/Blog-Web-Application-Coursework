@extends('layouts.app')

@section('title', 'Posts')

@section('content')
    @if (session('message'))
        <p><b>{{session('message')}} </b></p>    
    @endif

        @foreach ($posts as $post)
        <p> {{$post->title}} </p>
            <ul> 
                <ui> <a href="{{ route('posts.show', ['id' => $post->id]) }}"> {{ $post->title }} <ui>
            </ul>
        @endforeach

@endsection