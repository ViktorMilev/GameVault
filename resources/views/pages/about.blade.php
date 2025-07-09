@extends('layouts.app')

@section('title', $pageTitle)

@section('body')
    <main class="p-4 bg-purple-gradient">
        @include('pageComponents.about_page_container')
    </main>
@endsection