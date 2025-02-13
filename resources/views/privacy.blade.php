@extends('layouts.home')

@section('title', $page->name[app()->getLocale()])

@section('content')
@include('partials.page-hero', ['title' => $page->name[app()->getLocale()], 'description' => $page->description[app()->getLocale()]])
<div class="container my-5">
    <h1 class="text-center mb-4"> {{ $page->name[app()->getLocale()] }}</h1>
    
    <div class="privacy-content">
        {!! $page->sections['content'][app()->getLocale()] !!}
    </div>
</div>
@endsection
