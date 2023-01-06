@extends('layouts.app')

@section('title', 'User Details')
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
@vite('resources/css/app.css')
@section('content')
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
<div class="container mx-auto my-32">
        <div>
            <div class="bg-white relative shadow rounded-lg w-5/6 md:w-5/6  lg:w-4/6 xl:w-3/6 mx-auto">
                <div class="flex justify-center">
                @if($user->profile->image != null)
                        @if($user->profile->image->url != "")
                            <img src="{{url('image/'. $user->profile->image->url)}}" alt="" class="rounded-full mx-auto absolute -top-20 w-32 h-32 shadow-md border-4 border-white transition duration-200 transform hover:scale-110">
                        @else
                        <img src="https://avatars0.githubusercontent.com/u/35900628?v=4" alt="" class="rounded-full mx-auto absolute -top-20 w-32 h-32 shadow-md border-4 border-white transition duration-200 transform hover:scale-110">
                    @endif
                @else
                <img src="https://avatars0.githubusercontent.com/u/35900628?v=4" alt="" class="rounded-full mx-auto absolute -top-20 w-32 h-32 shadow-md border-4 border-white transition duration-200 transform hover:scale-110">

                @endif
                    </div>
                
                <div class="mt-16">
                    @if($user->is_admin)
                        <h1 class="font-bold text-center text-3xl text-red-900">{{$user->name}}</h1>
                        <p class="text-center text-sm text-red-400 font-medium">Administrator</p>

                    @else
                    <h1 class="font-bold text-center text-3xl text-gray-900">{{$user->name}}</h1>

                    @endif
                    <p class="text-center text-sm text-gray-400 font-medium">{{$user->profile->bio ?? 'No bio available'}}</p>
                    
                    <br>
                    <p class="text-center text-sm text-gray-400 font-medium">{{$user->profile->job ?? 'No job available'}}</p>
                    <p class="text-center text-sm text-gray-400 font-medium">{{$user->profile->dob ?? 'No dob available'}}</p>

                    <div class="flex justify-between items-center my-5 px-6">
                        <a href="" class="text-gray-500 hover:text-gray-900 hover:bg-gray-100 rounded transition duration-150 ease-in font-medium text-sm text-center w-full py-3">{{$user->email}}</a>
                    </div>

                @if(auth()->user()->is_admin || auth()->user()->id == $user->id)


                <!-- <label for="image">Upload an image..</label>
                <input type="file" name="image" value = "{{ old('image') }}"> -->
                
                <!-- <label for="content">Content:</label> -->
                <br>
                <!-- <p>Content: <input type="text" name="content" value = "{{ old('content') }}"></p> -->

                <!-- <input type="submit" value="Submit"> -->
                
                <div class="">
                    <form class= "flex justify-center" method="POST" action="{{ route('users.profile.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-6">
                            <label for="bio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Update your bio..</label>
                            <input type="text" id="bio" name="bio" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$user->profile->bio}}">
                            
                            <label for="job" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Update your job title..</label>
                            <input type="text" id="job" name="job" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$user->profile->job}}">
                
                            <label for="dob" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Update your date of birth..</label>
                            <input type="datetime-local" id="dob" name="dob" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$user->profile->dob}}">
                            
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="image">Upload file</label>
                            <input class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" name="image" type="file">
                            <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" name="image">Add an image to your post?</div>

                        <button type="submit" class="flex justify-center text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Update profile</button>
                    </form>


                </div>

                    @if(auth()->user()->is_admin)
                        @if($user->is_admin)
                            <form class= "flex justify-center" method="POST" action="{{ route('users.admin.remove', ['id' => $user->id]) }}">
                                @csrf
                                <button type="submit" class="flex justify-center text-white bg-purple-700 hover:bg-purple-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Remove admin</button>
                            </form>

                        @else
                            <form class= "flex justify-center" method="POST" action="{{ route('users.admin.make', ['id' => $user->id]) }}">
                                @csrf
                                <button type="submit" class="flex justify-center text-white bg-purple-700 hover:bg-purple-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Make admin</button>
                            </form>
                        @endif
                    @endif

                        <form class= "flex justify-center" method="DELETE" action="{{ route('users.destroy', ['id' => $user->id]) }}">
                            @csrf
                                <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"><a>Delete account</button>
                        </form>

                    </div>
                    @endif
        
                </div>
            </div>

        </div>
    </div>

    @php
        $posts_per_page = 3;
        $ccount = 0;
        $pcount = 0;
    @endphp
    <h1 class="flex justify-center b-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">{{$user->name . "'s "}} <span class="underline underline-offset-3 decoration-8 decoration-blue-400 dark:decoration-blue-600"> Posts</span></h1>
    <br><br>

    <div>      
        @foreach ($user->posts as $post)
        @if($pcount < $ppage * $posts_per_page && $pcount > ($ppage * $posts_per_page) - ($posts_per_page + 1) )

        <div class="flex bg-white shadow-lg rounded-lg mx-4 md:mx-auto my-8 max-w-md md:max-w-2xl "><!--horizantil margin is just for display-->
   <div class="flex items-start px-4 py-6">
   @if($post->image != null)
                        @if($post->image->url != "")
                        <img width="200" height = "200" src="{{ url('image/'. $post->image->url) }}" alt="">
                    @endif
                @endif
      <div class="">
         <div class="flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-900 -mt-1"> <a href="{{route('posts.show', ['id' => $post->id, 'page' => 1])}}">{{$post->title}}</a></h2>
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
               <span>{{count($post->upvotes)}}</span>
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

            @endif
            @php
                $pcount = $pcount + 1;
            @endphp
        @endforeach
    <div class="inline-flex">
            @if($ppage > 1)
                <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-l">
                <a href="{{route('users.show', ['id' => $user->id, 'ppage' => $ppage - 1, 'cpage' => $cpage])}}">Prev</a>
                </button>
            @endif
            @if($ppage < count($user->posts) / $posts_per_page)
                <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-r">
                <a href="{{route('users.show', ['id' => $user->id, 'ppage' => $ppage + 1, 'cpage' => $cpage])}}">Next</a>
                </button> 
            @endif
        </div>
    </div>
    <br>
    <h1 class="flex justify-center b-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">{{$user->name}} 's <span class="underline underline-offset-3 decoration-8 decoration-blue-400 dark:decoration-blue-600">Comments</span></h1>
    <div>
        @foreach ($user->comments as $comment)
        @if($ccount < $cpage * $posts_per_page && $ccount > ($cpage * $posts_per_page) - ($posts_per_page + 1) )
        <div class="p-8 bg-blue-100">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-2 text-gray-800"> <a href=" {{route('posts.show', ['id' => $comment->post->id, 'page' => 1])}}">{{$comment->post->title}}</a></h2>
                <p class="text-gray-700">{{$comment->text}}</p>
            </div>
        </div>
            @endif
            @php
                $ccount = $ccount + 1;
            @endphp
        @endforeach
    </div>
    <br><br>

    <div class="inline-flex">
            @if($cpage > 1)
                <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-l">
                <a href="{{route('users.show', ['id' => $user->id, 'ppage' => $ppage, 'cpage' => $cpage - 1])}}">Prev</a>
                </button>
            @endif
            @if($cpage < count($user->comments) / $posts_per_page)
                <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-r">
                <a href="{{route('users.show', ['id' => $user->id, 'ppage' => $ppage, 'cpage' => $cpage + 1])}}">Next</a>
                </button> 
            @endif
        </div>
@endsection