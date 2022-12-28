@extends('layouts.app')

@section('title', 'Posts')
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
@vite('resources/css/app.css')

@section('content')
    @php
        $posts_per_page = 3;
        $count = 0;
    @endphp
    <!-- <link href='/css/main.css' rel='stylesheet'> -->
    @if (session('message'))
        <p><b>{{session('message')}} </b></p>    
    @endif
        @foreach ($posts as $post)
            @if($count < $page * $posts_per_page && $count > ($page * $posts_per_page) - ($posts_per_page + 1) )

                <div class="flex bg-white shadow-lg rounded-lg mx-4 md:mx-auto my-8 max-w-md md:max-w-2xl "><!--horizantil margin is just for display-->
                <div class="flex items-start px-4 py-6">
                        @if($post->image != "")
                            <img width="200" height = "200" src="{{ url('image/'. $post->image) }}" alt="">
                        @endif
                    <div class="">
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg font-semibold text-gray-900 -mt-1"> <a href=" {{route('posts.show', ['id' => $post->id]) }}">{{$post->title}}</a></h2>
                            <small class="text-sm text-gray-700">22h ago</small>
                        </div>
                        <p class="text-gray-700"> </p>
                        <p class="mt-3 text-gray-700 text-sm">
                            {{$post->content}}
                        </p>
                        <div class="mt-4 flex items-center">
                            <div class="flex mr-2 text-gray-700 text-sm mr-3">
                            <svg fill="none" viewBox="0 0 24 24"  class="w-4 h-4 mr-1" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            <span>12</span>
                            </div>
                            <div class="flex mr-2 text-gray-700 text-sm mr-8">
                            <svg fill="none" viewBox="0 0 24 24" class="w-4 h-4 mr-1" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>
                            </svg>
                            <span>{{count($post->comments)}}</span>
                            </div>
                            <div class="flex mr-2 text-gray-700 text-sm mr-4">
                            <!-- <svg fill="none" viewBox="0 0 24 24" class="w-4 h-4 mr-1" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                </svg> -->
                            <span> <a href= "{{route('users.show', ['id' => $post->user->id, 'ppage' => 1, 'cpage' => 1])}}">posted by {{$post->user->name}} </a></span>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
        @endif
            @php
                $count = $count + 1;
            @endphp
        @endforeach
        <div class="inline-flex">
            @if($page > 1)
                <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-l">
                    <a href="{{route('posts.index', ['page' => $page - 1])}}">Prev</a>
                </button>
            @endif
            @if($page < count($posts) / $posts_per_page)
                <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-r">
                    <a href="{{route('posts.index', ['page' => $page + 1])}}">Next</a>
                </button> 
            @endif
        </div>
@endsection