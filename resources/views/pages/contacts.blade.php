@extends('layouts.app')

@section('title', $pageTitle)

@section('body')
    <main class="p-4 bg-orange-gradient">
        @include('page_sections.contacts_page_container')
    </main>
@endsection