@extends('layouts.admin')

@section('title', $pageTitle)

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
            'admin-title' => $t['admin']['categories_index_page']['page_headers']['categories'] ?? '',
            'admin-subtitle' => $t['admin']['categories_index_page']['page_subheaders']['categories'] ?? '',
            'actions' => [
                [
                    'label' => $t['admin']['categories_index_page']['create_btn_text']['categories'],
                    'route' => 'admin.entities.create',
                    'params' => ['entity' => 'categories', 'slug' => 'category']
                ],
                [
                    'label' => $t['admin']['categories_index_page']['create_btn_text']['subcategories'],
                    'route' => 'admin.entities.create',
                    'params' => ['entity' => 'subcategories', 'slug' => 'subcategory']
                ]
            ]
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
        'system_settings' => [
            'admin-title' => $t['admin']['system_settings']['title'] ?? 'System Settings',
            'admin-subtitle' => $t['admin']['system_settings']['subtitle'] ?? 'Manage your system settings',
            'label' => 'System Settings',
            'route' => 'admin.entities.create',
            'params' => ['entity' => ' ', 'slug' => ' ']
        ],
    ];

    $tableViews = [
        'games' => 'page_sections.admin_category_tables.admin_games_table',
        'categories' => 'page_sections.admin_category_tables.admin_categories_table',
        'game_platforms' => 'page_sections.admin_category_tables.admin_platforms_table',
        'users' => 'page_sections.admin_category_tables.admin_users_table',
        'system_settings' => 'page_sections.admin_category_tables.admin_system_settings_table',
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
                @if($menuActive !== 'system_settings')
                    <div class="dropdown dropstart">
                        <button class="btn btn-primary  dropdown-toggle no-arrow"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">
                            {{ $t['general']['create_new'] }}
                        </button>

                        <div class="dropdown-menu">
                            @if (isset($currentEntity['actions']))
                                @foreach ($currentEntity['actions'] as $action)
                                    <a href="{{ route($action['route'], $action['params']) }}" class="dropdown-item">
                                        {{ $t['general']['add'] }} {{ $action['label'] }}
                                    </a>
                                @endforeach
                            @else
                                @if($currentEntity)
                                    <a href="{{ route($currentEntity['route'], $currentEntity['params']) }}" class="dropdown-item">
                                        {{ $t['general']['add'] }} {{ $currentEntity['label'] }}
                                    </a>
                                @endif
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

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
    color: var(--admin-header-color-1);
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

.platform-icon-thumb {
    height: 50px;
    border-radius: 6px;
    background: white;
    padding: 4px;
}

.platform-badge {
    color: white;
    padding: 4px 8px;
    margin-right: 5px;
    border-radius: 6px;
    font-size: 12px;
}

.platform-badge:nth-child(odd) {
    background: var(--admin-primary-color-2);
}

.platform-badge:nth-child(even) {
    background: var(--admin-primary-color-3);
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
    background: var(--admin-primary-color-2);
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
    padding: 0;
    display: none;
    min-width: 160px;
    z-index: 999;
}

.dropdown-menu li {
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
    background: var(--admin-primary-color-2);
    color: var(--white);
}

.text-danger {
    color: #ef4444;
}

</style>
@endsection