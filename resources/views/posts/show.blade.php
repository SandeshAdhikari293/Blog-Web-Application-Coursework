@extends('layouts.app')

@section('title', 'Post')

@section('content')
    <head>
        @livewireStyles
    </head>
    <body>
        @livewireScripts
    @php
        $posts_per_page = 3;
        $count = 0;
    @endphp
    <form method="GET" action="{{ route('posts.index', ['page' => 1]) }}">
        @csrf
        <button>Go back</button>
    </form>

    <div class="flex bg-white shadow-lg rounded-lg mx-4 md:mx-auto my-8 max-w-md md:max-w-2xl "><!--horizantil margin is just for display-->
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
                <br>
                <h1 class="flex justify-center mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">View <span class="text-blue-600 dark:text-blue-500">Comments</span></h1>
                <br>
                
<!-- 
    <div class="flex justify-center">
        <div class ="block w-1/2 p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
        <h2 class="flex justify-center text-4xl font-extrabold dark:text-white">{{$post->title}}</h2>

        </div>
    </div> -->
    <!-- <div style="clear: left;">
        <br>
        <p>Comments:</p>    
        @foreach ($comments as $comment)
                <br>
                <ul> 
                    <div style="width:500px;height:100px;border:1px solid #000;">
                        <li> {{ $comment->text }} </li>
                        <br><br>
                        <li> Comment by <a href="{{ route('users.show', ['id' => $comment->user_id, 'ppage' => 1, 'cpage' => 1]) }}"> {{ $comment->user->name }} </a> </li>
                

                        @if(auth()->user()->is_admin || auth()->user()->id == $user->id)
                            <form method="DELETE" action="{{ route('comments.destroy', ['p_id' => $post->id, 'c_id' => $comment->id]) }}">
                                @csrf                
                                <input type="submit" value="Delete comment">
                            </form>
                        @endif

                    </div>
                </ul>
        @endforeach
        <br><br><br> -->

    </div>

    @if(auth()->user()->is_admin || auth()->user()->id == $user->id)

        <form method="DELETE" action="{{ route('posts.destroy', ['id' => $post->id]) }}">
            @csrf            
            <input type="submit" value="Delete post">
        </form>
    @else
        <p>not Admin log in</p>
    @endif

    <br><br><br>
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
    <!-- <div class="flex justify-center">
        <div class ="block w-1/2 p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
        <form method="POST" action="{{ route('comments.store', ['id' => $post->id]) }}">
                @csrf

            <textarea id="content" name="content" rows="4" cols="50">{{ old('content') }}</textarea> -->
            <!-- </form>
            <label for="comment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Add a comment to this post?</label>
                <textarea wire:model = "input" type ="text" name="comment" id="comment" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your comment..">{{ old('content') }}</textarea>

                <br>
                <p>Content: <input type="text" name="content" value = "{{ old('content') }}"></p>

                <input type="submit" value="Submit">
                <div class="flex justify-between">
                    <button class="btn btn-success btn-submit">Submit</button>
                    <button type="submit" wire:click="post(2)" id="btn-submit" name="btn-submit" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 btn-submit">Post comment</button>
                </div>
            </div>
</div> -->
<br><br>
    <!-- <div>
        <form method="POST" action="{{ route('comments.store', ['id' => $post->id]) }}">
            @csrf
            <p>Comment: <input type="text" name="comment" value = "{{ old('comment') }}"></p>
            
            <input type="submit" value="Submit">
            <a href=" {{ route('posts.index', ['page' => 1]) }}">Cancel</a>
        </form>
    </div> -->
    @livewire('counter', ['post' => $post])
    </body>
@endsection

