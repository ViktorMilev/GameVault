@extends('layouts.app')

@section('title', $pageTitle)

@section('body')
    <main class="bg-red-gradient">
        @include('page_sections.game_library', ['searched' => false])
    </main>
@endsection