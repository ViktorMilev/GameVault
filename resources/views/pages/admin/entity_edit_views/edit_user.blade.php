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

        <h2 class="mb-4 page-header">Редакция на потребител</h2>

        <div class="card card-custom p-4" style="background-color: var(--darkgray);">

            <form method="POST" action="{{ route('admin.entities.update', ['entity' => $entity, 'slug' => $slug]) }}" enctype="multipart/form-data">
                @csrf

                {{-- Basic Info --}}
                <h4 class="section-title">Basic Information</h4>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" value="{{ $entityData->username ?? 'N/A' }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $entityData->email ?? 'N/A' }}">
                    </div>
                </div>

                {{-- Account Settings --}}
                <h4 class="section-title">Account Settings</h4>

                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select class="form-select" name="role">
                        <option value="user" {{ ($entityData->role ?? 'user') == 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ ($entityData->role ?? 'user') == 'admin' ? 'selected' : '' }}>Administrator</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label">Status</label>
                    <select class="form-select" name="status">
                        <option value="active" {{ ($entityData->status ?? 'active') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ ($entityData->status ?? 'active') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="banned" {{ ($entityData->status ?? 'active') == 'banned' ? 'selected' : '' }}>Banned</option>
                    </select>
                </div>

                {{-- Profile Image --}}
                <h4 class="section-title">Profile Image</h4>

                @if($entityData->avatar ?? false)
                    <div class="mb-3">
                        <label class="form-label">Current Profile Image</label>
                        <div>
                            <img src="{{ asset('storage/' . $entityData->avatar) }}" alt="Profile Image" class="img-thumbnail" style="max-width: 150px;">
                        </div>
                    </div>
                @endif

                <div class="mb-4">
                    <label class="form-label">Upload New Profile Image</label>
                    <input type="file" class="form-control" name="avatar" accept="image/*">
                    <small class="form-text text-muted">Leave empty to keep current image. Supported formats: JPG, PNG, GIF.</small>
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