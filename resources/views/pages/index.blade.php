@extends('layouts.app')

@section('title', $pageTitle)

@section('body')
    <main class="bg-red-gradient">
        @include('pageComponents.game_library', ['searched' => false])
    </main>
@endsection