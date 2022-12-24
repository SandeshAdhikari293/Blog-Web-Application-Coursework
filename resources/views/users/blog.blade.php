@extends('layouts.app')

@section('title', 'Posts')

@section('content')
    <link href='/css/main.css' rel='stylesheet'>
    <p>View all posts</p>
    @if (session('message'))
        <p><b>{{session('message')}} </b></p>    
    @endif

        @foreach ($posts as $post)
            <ul> 
                <div class="centre">
                    <div class="postbox">
                        <ui  style="font-size:20;" ><a href="{{ route('posts.show', ['id' => $post->id]) }}"> {{ $post->title }} </a> </ui>
                        <br><br><br>
                        <ui> <a href="{{ route('users.show', ['id' => $post->user->id]) }}"> Posted by {{ $post->user->name }} </a> </ui>
                    </div>
                </div>
            </ul>
        @endforeach

@endsection