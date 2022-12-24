@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <p> {{$users[0]->name}} </p>
        @foreach ($users as $user)
            <ul> 
                <li> <a href="{{ route('users.show', ['id' => $user->id]) }}"> {{ $user->name }} </a></li>
            </ul>
        @endforeach

@endsection