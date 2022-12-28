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

                <div class="mx-4 md:mx-auto my-8 max-w-md md:max-w-2xl p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$user->name}}</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$user->email}}</p>
                    <a href="{{route('users.show', ['id' => $user->id, 'ppage' => 1, 'cpage' => 1])}}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        View user details
                        <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </a>
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