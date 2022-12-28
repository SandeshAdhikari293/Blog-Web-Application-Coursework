@extends('layouts.app')

@section('title', 'New post')

@section('content')
<h1 class="flex justify-center b-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Create a new <span class="underline underline-offset-3 decoration-8 decoration-blue-400 dark:decoration-blue-600"> post</span></h1>
    <br><br>    
<div class="flex justify-center">
        <div class ="block w-1/2 p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
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
            <form method="POST" action="{{ route('posts.store') }}"  enctype="multipart/form-data">
                @csrf

                
                <!-- <p>Title: <input type="text" name="title" value = "{{ old('title') }}"></p> -->

                <div class="mb-6">
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Post title</label>
                    <input type="text" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('title') }}">
                </div>

                <!-- <label for="image">Upload an image..</label>
                <input type="file" name="image" value = "{{ old('image') }}"> -->
                
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="image">Upload file</label>
                <input class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" name="image" type="file">
                <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" name="image">Add an image to your post?</div>

                <br>
                <!-- <label for="content">Content:</label> -->
                <br>
                <!-- <textarea id="content" name="content" rows="4" cols="50">{{ old('content') }}</textarea> -->
                <label for="content" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">What is your post about?</label>
                <textarea name="content" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your post...">{{ old('content') }}</textarea>

                <br>
                <!-- <p>Content: <input type="text" name="content" value = "{{ old('content') }}"></p> -->

                <!-- <input type="submit" value="Submit"> -->
                <div class="flex justify-between">
                    <button type="button" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"><a href=" {{ route('posts.index', ['page' => 1]) }}">Cancel</a></button>

                    <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Create post</button>
                </div>
            </form>
    </div>
    </div>
@endsection