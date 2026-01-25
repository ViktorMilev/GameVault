@extends('layouts.app')

@section('title', $pageTitle)

@section('body')
    <main>
        <div class="bg-cyan-gradient">
            @include('page_sections.game_library', ['searched' => true])
        </div>
    </main>
@endsection