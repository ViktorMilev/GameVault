@extends('layouts.app')

@section('title', $pageTitle)

@section('body')
    <main class="p-4 bg-purple-gradient">
        @include('page_sections.game_article', [])
    </main>
@endsection