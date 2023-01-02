@extends('layouts.app')

@section('title', 'Post')

@section('content')
    <head>
        @livewireStyles
    </head>
    <body>
        @livewireScripts
    <form method="GET" action="{{ route('posts.index', ['page' => 1]) }}">
        @csrf
        <button>Go back</button>
    </form>

    <div class="flex bg-white shadow-lg rounded-lg mx-4 md:mx-auto my-8 max-w-md md:max-w-2xl">
                <div class="flex items-start px-4 py-6">
                        @if($post->image != "")
                            <img width="200" height = "200" src="{{ url('image/'. $post->image) }}" alt="">
                        @endif
                    <div class="">
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg font-semibold text-gray-900 -mt-1"> <a href=" {{route('posts.show', ['id' => $post->id, 'page' => 1]) }}">{{$post->title}}</a></h2>
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
    </div>

    @if(auth()->user()->is_admin || auth()->user()->id == $user->id)

        <form method="DELETE" action="{{ route('posts.destroy', ['id' => $post->id]) }}">
            @csrf            
            <input type="submit" value="Delete post">
        </form>
    @else
        <p>not Admin log in</p>
    @endif

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
    @livewire('counter', ['post' => $post])
    </body>
@endsection

