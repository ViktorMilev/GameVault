@extends('layouts.admin')

@php
    use Illuminate\Support\Carbon;
@endphp

@section('title', $pageTitle)

@section('body')
<main>
    <div class="d-flex">
        @include('shared_components.admin_layout_sidebar')

        {{-- Main content --}}
        <div class="content flex-grow-1">
            <div class="dashboard-header">
                <h1>Welcome, Admin!</h1>
                <span class="status online">Status: <strong>Online</strong></span>
            </div>

            {{-- Stats cards --}}
            <div class="row g-4 mb-4">
                <div class="col-md-3">
                    <div class="card card-custom p-3">
                        <h5>Total Games Count</h5>
                        <p class="fs-3 text-light">{{ $categoryEntitiesCountMap['games'] }}</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-custom p-3">
                        <h5>Game Categories</h5>
                        <p class="fs-3 text-light">{{ $categoryEntitiesCountMap['game_categories'] }}</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-custom p-3">
                        <h5>Game Platforms</h5>
                        <p class="fs-3 text-light">{{ $categoryEntitiesCountMap['game_platgorms'] }}</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-custom p-3">
                        <h5>Users</h5>
                        <p class="fs-3 text-light">{{ $categoryEntitiesCountMap['users'] }}</p>
                    </div>
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card card-custom p-3">
                        <h5>Add a new game</h5>
                        <p>Quickly add new games to the site.</p>
                        <a href="{{ route('admin.entities.create', ['entity' => 'games', 'slug' => 'game']) }}" class="button btn btn-light w-100">Add</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-custom p-3">
                        <h5>User management</h5>
                        <p>Editing and viewing all users.</p>
                        <a href="{{ route('admin.categories.index', ['entity' => 'users']) }}" class="button btn btn-light w-100">Manage</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-custom p-3">
                        <h5>System settings</h5>
                        <p>Change site settings and configurations.</p>
                        <a href="#" class="button btn btn-light w-100">Manage</a>
                    </div>
                </div>
            </div>

            {{-- Table example --}}
            <div class="mt-5">
                <h3>Latest games</h3>
                <div class="admin-custom-table-1 table table-dark table-striped mt-3">
                    <div>
                        <div>
                            <div>Name</div>
                            <div>Platforms</div>
                            <div>Category</div>
                            <div>Date added</div>
                        </div>
                    </div>
                    <div>
                        @foreach($latestGames as $game)                           
                            @php
                                $currentGamePlatforms = [];
                            @endphp
                            @foreach($game->platforms as $platform)
                                @php
                                    $currentGamePlatforms[] = $platform->name;
                                @endphp
                            @endforeach
                            @php
                                $maxPlatformsToShow = 4;
                                if (count($currentGamePlatforms) > $maxPlatformsToShow) {
                                    $currentGamePlatforms = array_slice($currentGamePlatforms, 0, $maxPlatformsToShow);
                                    $currentGamePlatforms[] = '...';
                                }
                            @endphp
                        <div>
                            <div>{{ $game['name'] }}</div>
                            <div>{{ implode(', ', $currentGamePlatforms) }}</div>
                            <div>{{ $game->category->name }}</div>
                            <div>{{ Carbon::parse($game['release_date'])->format('Y-m-d H:i:s') }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>
@endsection