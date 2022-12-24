@extends('layouts.app')

@section('title', 'New post')

@section('content')
    <h1> Create a new post </h1>

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

    <form method="POST" action="{{ route('posts.store') }}">
        @csrf
        <p>Title: <input type="text" name="title" value = "{{ old('title') }}"></p>
        <p>Content: <input type="text" name="content" value = "{{ old('content') }}"></p>

        <input type="submit" value="Submit">
        <a href=" {{ route('posts.index') }}">Cancel</a>
    </form>

@endsection