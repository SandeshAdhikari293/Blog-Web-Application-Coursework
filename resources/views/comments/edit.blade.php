


@extends('layouts.app')

@section('title', 'Post')

@section('content')
    <div class="flex justify-center">
            <div class ="block w-1/2 p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <form method="POST" action="{{ route('comments.edit.store', ['id' => $comment->id]) }}">
                    @csrf    
                    <label for="comment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Edit your comment...</label>
                    <textarea type ="text" name="comment" id="comment" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your comment..">{{ $comment->text }}</textarea>
                    <br>
                    <div class="flex justify-between">
                        <button type="submit" id="btn-submit" name="btn-submit" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 btn-submit">Edit comment</button>
                    </div>
                </div>
            </form>
        </div>
@endsection
