@extends('layouts.app')

@section('title', 'Post')

@section('content')
    <head>
        @livewireStyles
    </head>
    <body>
        @livewireScripts
    <!-- <form method="GET" action="{{ route('posts.index', ['page' => 1]) }}">
        @csrf
        <button>Go back</button>
    </form> -->


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
    @livewire('counter', ['post' => $post, 'upvotes' => count($post->upvotes)])
    </body>
@endsection

