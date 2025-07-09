@extends('layouts.app')

@section('title', $pageTitle)

@section('body')
    <main class="p-4 bg-orange-gradient">
        @include('pageComponents.contacts_page_container')
    </main>
@endsection