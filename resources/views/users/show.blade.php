@extends('layouts.app')

@section('title', 'User Details')

@section('content')
    <h1 class="flex justify-center b-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">{{$user->name . "'s "}} <span class="underline underline-offset-3 decoration-8 decoration-blue-400 dark:decoration-blue-600"> Posts</span></h1>
    <br><br>
    <form class= "flex justify-center" method="DELETE" action="{{ route('users.destroy', ['id' => $user->id]) }}">
        @csrf
        <input type="submit" class="btn btn-danger delete-user" value="Delete user">            
        <!-- <button type="button" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete user</button> -->
    </form>
    <br>
    @if(auth()->user()->is_admin || auth()->user()->id == $user->id)
    <br>
    <div>      
        @foreach ($user->posts as $post)
        <div class="flex bg-white shadow-lg rounded-lg mx-4 md:mx-auto my-8 max-w-md md:max-w-2xl "><!--horizantil margin is just for display-->
   <div class="flex items-start px-4 py-6">
        @if($post->image != "")
            <img width="200" height = "200" src="{{ url('image/'. $post->image) }}" alt="">
        @endif
      <div class="">
         <div class="flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-900 -mt-1"> {{$post->title}}</h2>
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
               <span>posted by {{$post->user->name}}</span>
            </div>
         </div>
      </div>
   </div>
</div>
            <!-- <ul>
                <li> <a href="{{ route('posts.show', ['id' => $post->id]) }}"> {{ $post->title }} </a> </li> 
            </ul> -->
        @endforeach

    </div>
    <br>
    <h1 class="flex justify-center b-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">{{$user->name}} 's <span class="underline underline-offset-3 decoration-8 decoration-blue-400 dark:decoration-blue-600">Comments</span></h1>
    <div>
        @foreach ($user->comments as $comment)
        <div class="p-20 bg-blue-100">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-2 text-gray-800">{{$comment->post->title}}</h2>
                <p class="text-gray-700">{{$comment->text}}</p>
            </div>
        </div>
            <!-- <ul>
                <li> <a href="{{ route('posts.show', ['id' => $comment->post->id]) }}"> {{ $comment->post->title }} : {{$comment->text}} </a> </li> 
            </ul> -->
        @endforeach
    </div>
    <br><br>

    @endif

@endsection