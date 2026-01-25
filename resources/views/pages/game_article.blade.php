@extends('layouts.app')

@section('title', $pageTitle)

@section('body')
    <main>
        @include('page_sections.game_article', [])
    </main>
@endsection