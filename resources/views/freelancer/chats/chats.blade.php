@extends('layouts.admin')

@section('title', __('Chats'))

@vite(['resources/js/echo.js', 'resources/js/bootstrap.js'])

@section('content')
@include('Chatify::pages.app')
@endsection

@section('page-styles')
    <style>
        @media (max-width: 576px) {
            #header {
                display: none !important;
            }
        }
    </style>
@endsection
