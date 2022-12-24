@extends('layouts.app')

@section('title', 'User posts')

@section('content')
    @if (session('message'))
        <p><b>{{session('message')}} </b></p>    
    @endif

        @foreach ($user->posts as $post)
            <ul> 
                <div style="width:500px;height:100px;border:1px solid #000;">
                    <ui> <a href="{{ route('posts.show', ['id' => $post->id]) }}"> {{ $post->title }} </a> </ui>
                    <br><br><br>
                    <ui> <a href="{{ route('users.show', ['id' => $post->user->id]) }}"> Posted by {{ $post->user->name }} </a> </ui>

                </div>
            </ul>
        @endforeach

@endsection