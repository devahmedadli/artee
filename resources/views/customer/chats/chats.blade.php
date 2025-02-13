@extends('layouts.home')

@section('title', __('Chats'))

@vite(['resources/js/echo.js', 'resources/js/bootstrap.js'])
@section('content')
    @include('Chatify::pages.app')
@endsection
