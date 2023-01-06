@extends('layouts.app')

@section('title', 'Users')
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
@vite('resources/css/app.css')
@section('content')
    @php
        $posts_per_page = 3;
        $count = 0;
    @endphp
        @foreach ($users as $user)
            @if($count < $page * $posts_per_page && $count > ($page * $posts_per_page) - ($posts_per_page + 1) )
            <div class="container mx-auto my-60">
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

                    <p class="text-center text-sm text-gray-400 font-medium">{{$user->profile->bio}}</p>
                    <br>
                    <p class="text-center text-sm text-gray-400 font-medium">{{$user->profile->job}}</p>
                    <p class="text-center text-sm text-gray-400 font-medium">{{$user->profile->dob}}</p>
                    <p>
                        <span>
                            
                        </span>
                    </p>
                    <div class="my-5 px-6">
                        <a href="{{route('users.show', ['id' => $user->id, 'cpage' => 1, 'ppage' => 1])}}" class="text-gray-200 block rounded-lg text-center font-medium leading-6 px-6 py-3 bg-gray-900 hover:bg-black hover:text-white">View activity</a>
                    </div>
                    <div class="flex justify-between items-center my-5 px-6">
                        <a href="" class="text-gray-500 hover:text-gray-900 hover:bg-gray-100 rounded transition duration-150 ease-in font-medium text-sm text-center w-full py-3">{{$user->email}}</a>
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
                    <a href="{{route('users.index', ['page' => $page - 1])}}">Prev</a>
                </button>
            @endif
            @if($page < count($users) / $posts_per_page)
                <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-r">
                    <a href="{{route('users.index', ['page' => $page + 1])}}">Next</a>
                </button> 
            @endif
        </div>
@endsection