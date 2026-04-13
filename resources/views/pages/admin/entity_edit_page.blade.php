@extends('layouts.admin')

<link rel="stylesheet" href="{{ asset('css/admin_styles.css') }}">

@section('title', $pageTitle)

@section('body')
<body>

@php
    $entity = request()->route('entity') ?? '';
    $slug = request()->route('slug') ?? '';
@endphp

<div class="d-flex">
    @include('shared_components.admin_layout_sidebar')

    {{-- Content --}}
    @include('page_sections.admin_entity_editor.' . $entityBladeFileName)
</div>
</body>
@endsection