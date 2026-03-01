{{-- Sidebar --}}
<nav class="sidebar d-flex flex-column">
    <div class="d-flex justify-content-center text-center" style="font-size: 25pt;">
        @include('shared_components.logo_static')
    </div>
    @php
        $menuActive = request()->route('entity') ?? 'dashboard';

        $menuItems = [
            'dashboard' => [
                'label' => 'Dashboard',
                'route' => 'admin.dashboard',
                'params' => []
            ],
            'games' => [
                'label' => 'Игри',
                'route' => 'admin.categories.index',
                'params' => ['entity' => 'games']
            ],
            'game_platforms' => [
                'label' => 'Платформи',
                'route' => 'admin.categories.index',
                'params' => ['entity' => 'game_platforms']
            ],
            'categories' => [
                'label' => 'Категории',
                'route' => 'admin.categories.index',
                'params' => ['entity' => 'categories']
            ],
            'subcategories' => [
                'label' => 'Подкатегории',
                'route' => 'admin.categories.index',
                'params' => ['entity' => 'subcategories']
            ],
            'users' => [
                'label' => 'Потребители',
                'route' => 'admin.categories.index',
                'params' => ['entity' => 'users']
            ],
            'system_settings' => [
                'label' => 'Системни настройки',
                'route' => 'admin.categories.index',
                'params' => ['entity' => 'system_settings']
            ],
        ];
    @endphp
    <div class="d-flex flex-column menu">
        @foreach ($menuItems as $key => $item)
            <a href="{{ route($item['route'], $item['params']) }}"
               class="{{ $menuActive === $key ? 'active' : '' }}">
                {{ $item['label'] }}
            </a>
        @endforeach
    </div>
    <form action="{{ route('admin.logout') }}" method="POST" class="mt-auto px-3">
        @csrf
        <button type="submit" class="btn w-100 logout-btn">Logout</button>
    </form>     
</nav>