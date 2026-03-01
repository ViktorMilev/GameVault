@extends('layouts.admin')


    <style>
        body {
            background-color: #1b1b2f;
            color: #f5f5f5;
        }

        .sidebar {
            background: linear-gradient(180deg, #4b0082, #2e004f);
            min-height: 100vh;
            padding-top: 2rem;
        }

        .sidebar a {
            display: block;
            color: #fff;
            padding: 0.8rem 1.2rem;
            text-decoration: none;
            transition: 0.2s;
        }

        .sidebar a:hover {
            background-color: #6a0dad;
        }

        .content {
            padding: 2rem;
        }

        .card-custom {
            background-color: #2b2b4a;
            border: none;
            border-radius: 12px;
        }

        .form-control, .form-select {
            background-color: #22223b;
            color: #fff;
            border: 1px solid #6a0dad;
        }

        .form-control:focus {
            border-color: #a64dff;
            box-shadow: 0 0 5px #a64dff;
        }

        .btn-purple {
            background-color: #8000ff;
            border: none;
        }

        .btn-purple:hover {
            background-color: #a64dff;
        }

        .section-title {
            color: #f8eeff;
            border-bottom: 2px solid;
                border-image: linear-gradient(
                    90deg,
                    var(--magenta),
                    var(--yellow),
                    var(--orange),
                    var(--yellow),
                    var(--magenta)
                ) 1;
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .form-label {
            color: var(--white);
        }
    </style>

@section('title', $pageTitle)

@section('body')
<body>

<div class="d-flex">
    @include('shared_components.admin_layout_sidebar')

    {{-- Content --}}
    <div class="content flex-grow-1">

        <h2 class="mb-4">Редакция на игра</h2>

        <div class="card card-custom p-4" style="background-color: var(--darkgray);">

            <form method="POST" action="#">
                @csrf
                @method('PUT')

                {{-- Basic Info --}}
                <h4 class="section-title">Основна информация</h4>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Име на играта</label>
                        <input type="text" name="title" class="form-control" value="Cyber Adventure">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Slug</label>
                        <input type="text" name="slug" class="form-control" value="cyber-adventure">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Кратко описание</label>
                    <textarea name="short_description" rows="3" class="form-control">
Fast-paced futuristic action game.
                    </textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label">Пълно описание</label>
                    <textarea name="description" rows="6" class="form-control">
Long detailed description of the game...
                    </textarea>
                </div>

                {{-- Classification --}}
                <h4 class="section-title">Категоризация</h4>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Категория</label>
                        <select class="form-select" name="category_id">
                            <option>Action</option>
                            <option>RPG</option>
                            <option>Strategy</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Подкатегория</label>
                        <select class="form-select" name="subcategory_id">
                            <option>Shooter</option>
                            <option>Open World</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Платформи</label>
                        <select multiple class="form-select" name="platforms[]">
                            <option selected>Windows</option>
                            <option>Android</option>
                            <option>Linux</option>
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