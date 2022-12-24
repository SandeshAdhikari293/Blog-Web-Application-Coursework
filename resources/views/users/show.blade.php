@extends('layouts.app')

@section('title', 'User Details')

@section('content')
    <p> {{$user->name}} </p>
    <p> {{$user->email}} </p>

@endsection