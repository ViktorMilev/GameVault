@extends('layouts.admin')

@section('title', $pageTitle)

@section('body')
<main>
    <div class="d-flex">
        @include('shared_components.admin_layout_sidebar')

        {{-- Main content --}}
        <div class="content flex-grow-1">
            <div class="dashboard-header">
                <h1>Добре дошъл, Admin!</h1>
                <span class="status online">Статус: <strong>Online</strong></span>
            </div>

            {{-- Stats cards --}}
            <div class="row g-4 mb-4">
                <div class="col-md-3">
                    <div class="card card-custom p-3">
                        <h5>Общо Игри</h5>
                        <p class="fs-3 text-light">120</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-custom p-3">
                        <h5>Платформи</h5>
                        <p class="fs-3 text-light">8</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-custom p-3">
                        <h5>Потребители</h5>
                        <p class="fs-3 text-light">540</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-custom p-3">
                        <h5>Категории</h5>
                        <p class="fs-3 text-light">12</p>
                    </div>
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card card-custom p-3">
                        <h5>Добави нова игра</h5>
                        <p>Бързо добавяне на нови заглавия в сайта.</p>
                        <a href="#" class="btn btn-light w-100">Добави</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-custom p-3">
                        <h5>Управление на потребители</h5>
                        <p>Редакция и преглед на всички потребители.</p>
                        <a href="#" class="btn btn-light w-100">Управлявай</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-custom p-3">
                        <h5>Системни настройки</h5>
                        <p>Промени настройки и конфигурации на сайта.</p>
                        <a href="#" class="btn btn-light w-100">Настройки</a>
                    </div>
                </div>
            </div>

            {{-- Table example --}}
            <div class="mt-5">
                <h3>Последни игри</h3>
                <table class="table table-dark table-striped mt-3">
                    <thead>
                        <tr>
                            <th>Име</th>
                            <th>Платформи</th>
                            <th>Категория</th>
                            <th>Дата на добавяне</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Cyber Adventure</td>
                            <td>Windows, Android</td>
                            <td>Action</td>
                            <td>2026-02-08</td>
                        </tr>
                        <tr>
                            <td>Pixel Quest</td>
                            <td>Windows</td>
                            <td>Indie</td>
                            <td>2026-02-07</td>
                        </tr>
                        <tr>
                            <td>Galaxy Raiders</td>
                            <td>Windows, Android</td>
                            <td>RPG</td>
                            <td>2026-02-05</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</main>
@endsection