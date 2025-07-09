@extends('layouts.app')

@section('title', $pageTitle)

@section('body')
    <main>
        @include('pageComponents.game_library', ['searched' => false])
    </main>
@endsection