<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        @foreach($navbarItems as $item)
          @if ($item['type'] === 'homeIndex')
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="{{ $item['route'] }}">{{ $item['name'] }}</a>
            </li>
          @endif

          @if ($item['type'] === 'dropdown')
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{ $item['name'] }}
              </a>
              <ul class="dropdown-menu">
                @foreach($categories as $category)
                  <li class="dropdown-submenu">
                    <a class="dropdown-item dropdown-toggle" href="#">{{ $category->name }}</a>
                    <ul class="dropdown-menu">
                      @foreach($category->subcategories as $subcat)
                        <li><a class="dropdown-item" href="{{ route('categories.index', ['slug' => $subcat->slug]) }}">{{ $subcat->name }}</a></li>
                      @endforeach
                    </ul>
                  </li>
                @endforeach
              </ul>
            </li>
          @endif

          @if ($item['type'] === 'singular')
            <li class="nav-item">
              <a class="nav-link" href="{{ $item['route'] }}">{{ $item['name'] }}</a>
            </li>
          @endif
        @endforeach
      </ul>
      <form class="d-flex" role="search" action="{{ route('search') }}" method="GET">
        <input class="form-control me-2" type="search" name="q" placeholder="Search games..." aria-label="Search"/>
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>