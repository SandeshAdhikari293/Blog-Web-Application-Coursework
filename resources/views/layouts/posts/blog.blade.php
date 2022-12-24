@extends('layouts.app')

@section('title', 'Posts')

@section('content')
        @foreach ($posts as $post)
        <p> {{$post->title}} </p>
            <ul> 
                <ui> {{ $post->title }} <ui>
                <ui> {{ $post->content }} <ui>
            </ul>
        @endforeach

@endsection