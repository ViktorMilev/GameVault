@extends('layouts.admin')

<link rel="stylesheet" href="{{ asset('css/admin_styles.css') }}">

@section('title', $pageTitle)

@section('body')
<body>

@php
    $entity = request()->route('entity') ?? '';
    $slug = request()->route('slug') ?? '';
@endphp

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="d-flex">
    @include('shared_components.admin_layout_sidebar')

    {{-- Content --}}
    <div class="content flex-grow-1">

        <h2 class="mb-4 page-header">Редакция на игра</h2>

        <div class="card card-custom p-4" style="background-color: var(--darkgray);">

            <form method="POST" action="{{ route('admin.entities.update', ['entity' => $entity, 'slug' => $slug]) }}" enctype="multipart/form-data">
                @csrf

                {{-- Basic Info --}}
                <h4 class="section-title">Основна информация</h4>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Име на играта</label>
                        <input type="text" name="title" class="form-control" value="{{ $entityData->name ?? 'N/A' }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Slug</label>
                        <input type="text" name="slug" class="form-control" value="{{ $entityData->slug ?? 'N/A' }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Кратко описание</label>
                    <textarea name="short_description" rows="3" class="form-control">{{ $entityData->description ?? 'N/A' }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label">Пълно описание</label>
                    <textarea name="description" rows="6" class="form-control">Long detailed description of the game...</textarea>
                </div>

                {{-- Classification --}}
                <h4 class="section-title">Категоризация</h4>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Категория</label>
                        <select class="form-select" name="category_id">
                            @foreach($gameCategories as $category)
                                <option value="{{ $category->id }}" {{ (isset($entityData) && $entityData->category_id == $category->id) ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Подкатегория</label>
                        <select class="form-select" name="subcategory_id">
                            @foreach($gameSubcategories as $subcategory)
                                <option value="{{ $subcategory->id }}" {{ (isset($entityData) && $entityData->subcategory_id == $subcategory->id) ? 'selected' : '' }}>
                                    {{ $subcategory->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Платформи</label>
                        <select class="form-select" name="platforms[]" multiple>
                            @foreach($gamePlatforms as $platform)
                                <option value="{{ $platform->id }}" {{ (isset($entityData) && $entityData->platforms->contains($platform->id)) ? 'selected' : '' }}>
                                    {{ $platform->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Media --}}
                <h4 class="section-title">Медия</h4>

                <div class="mb-3">
                    <label class="form-label">Главно изображение</label>
                    <input type="file" class="form-control" name="thumbnail">
                </div>

                <div class="mb-3">
                    <label class="form-label">Gallery изображения</label>
                    <input type="file" class="form-control" name="gallery[]" multiple>
                </div>

                <div class="mb-4">
                    <label class="form-label">YouTube Trailer URL</label>
                    <input type="text" class="form-control" name="trailer_url">
                </div>

                {{-- SEO --}}
                <h4 class="section-title">SEO настройки</h4>

                <div class="mb-3">
                    <label class="form-label">Meta Title</label>
                    <input type="text" class="form-control" name="meta_title">
                </div>

                <div class="mb-4">
                    <label class="form-label">Meta Description</label>
                    <textarea rows="3" class="form-control" name="meta_description"></textarea>
                </div>

                {{-- Actions --}}
                <div class="d-flex justify-content-between">
                    <a href="#" class="btn btn-secondary">Отказ</a>
                    <button type="submit" class="btn btn-purple px-4">Запази промените</button>
                </div>

            </form>

        </div>

    </div>
</div>
</body>
@endsection