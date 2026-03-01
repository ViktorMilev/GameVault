@extends('layouts.admin')

@section('title', 'Admin • Games')

@section('body')
@php
    $menuActive = request()->route('entity') ?? '';

    $createBtnItems = [
        'games' => [
            'admin-title' => 'Games',
            'admin-subtitle' => 'Create, manage and delete all game entries in your database',
            'label' => 'A New Game',
            'route' => 'admin.entities.create',
            'params' => ['entity' => 'games', 'slug' => 'game']
        ],
        'categories' => [
            'admin-title' => 'Categories',
            'admin-subtitle' => 'Create, manage and delete all categories in your database',
            'label' => 'A New Category',
            'route' => 'admin.entities.create',
            'params' => ['entity' => 'categories', 'slug' => 'category']
        ],
        'game_platforms' => [
            'admin-title' => 'Game Platforms',
            'admin-subtitle' => 'Create, manage and delete all game platforms in your database',
            'label' => 'A New Game Platform',
            'route' => 'admin.entities.create',
            'params' => ['entity' => 'platforms', 'slug' => 'platform']
        ],
        'users' => [
            'admin-title' => 'Users',
            'admin-subtitle' => 'Create, manage and delete all users in your database',
            'label' => 'A New User',
            'route' => 'admin.entities.create',
            'params' => ['entity' => 'users', 'slug' => 'users']
        ],
    ];

    $tableViews = [
        'games' => 'page_sections.admin_category_tables.admin_games_table',
        'categories' => 'page_sections.admin_category_tables.admin_categories_table',
        'game_platforms' => 'page_sections.admin_category_tables.admin_platforms_table',
        'users' => 'page_sections.admin_category_tables.admin_users_table',
    ];

    $currentEntity = $createBtnItems[$menuActive] ?? null;

    $currentTable = $tableViews[$menuActive] ?? null;
@endphp
<main>
    <div class="d-flex">
        @include('shared_components.admin_layout_sidebar')
        
        {{-- Main content --}}
        <div class="content flex-grow-1 admin-container">

            {{-- HEADER --}}
            <div class="admin-header">
                <div>
                    @if($currentEntity)
                        <h1 class="admin-title">{{ $currentEntity['admin-title'] }}</h1>
                        <p class="admin-subtitle">{{ $currentEntity['admin-subtitle'] }}</p>
                    @endif
                </div>

                {{-- CREATE BUTTON DROPDOWN --}}
                <div class="dropdown dropstart">
                    <button class="btn btn-primary  dropdown-toggle no-arrow"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">
                        Create New
                    </button>

                    <div class="dropdown-menu">
                        @if($currentEntity)
                            <a href="{{ route($currentEntity['route'], $currentEntity['params']) }}" class="dropdown-item">
                                Add {{ $currentEntity['label'] }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            @if($currentTable)
                @include($currentTable)
            @endif
        </div>
    </div>
</main>


{{-- STYLES --}}
<style>
.admin-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.admin-title {
    color: #c084fc;
    font-size: 28px;
    font-weight: bold;
}

.admin-subtitle {
    color: #888;
}

.admin-card {
    overflow-y: scroll;
    height: 45rem;
    background: #16161d;
    border-radius: 12px;
    padding: 20px;
}

.admin-table {
    width: 100%;
    border-collapse: collapse;
}

.admin-table th {
    color: #aaa;
    text-align: left;
    padding: 12px;
    border-bottom: 1px solid #333;
}

.admin-table td {
    padding: 12px;
    border-bottom: 1px solid #222;
}

.admin-table tr:hover {
    background: #1f1f2a;
}

.game-cover-thumb {
    height: 60px;
    border-radius: 6px;
}

.platform-badge {
    background: #6d28d9;
    color: white;
    padding: 4px 8px;
    margin-right: 5px;
    border-radius: 6px;
    font-size: 12px;
}

.status-badge {
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 12px;
}

.status-badge.active {
    background: #16a34a;
}

.btn {
    padding: 8px 14px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
}

.btn-primary {
    background: #7c3aed;
    color: white;
}

.btn-primary:hover {
    background: #6d28d9;
}

.btn-icon {
    background: transparent;
    color: #aaa;
    font-size: 18px;
}

.dropdown {
    position: relative;
}

.dropdown-menu {
    position: absolute;
    background: #1e1e28;
    border-radius: 8px;
    padding: 8px;
    display: none;
    min-width: 160px;
    z-index: 999;
}

.dropdown-right {
    right: 0;
}

.dropdown-item {
    display: block;
    padding: 8px;
    color: white;
    text-decoration: none;
}

.dropdown-item:hover {
    background: #6d28d9;
}

.text-danger {
    color: #ef4444;
}

</style>
@endsection