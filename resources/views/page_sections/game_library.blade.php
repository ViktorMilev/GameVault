@if(!$games->isEmpty())
<div class="game-gallery">
  @if($searched)
       <h2 class="w-100 text-light">Search Results for "{{ $query }}"</h2>
  @endif

  @foreach($games as $game)
      <div class="game-box">
        <a href="{{ route('game.article', ['slug' => $game->slug]) }}">
          <div class="cover">
            <img src="{{ asset(Config::get('site_vars.cover_url') . '/' . $game->cover_image) }}" alt="{{ $game->name }}">
          </div>
          <div class="info">
            <h3 class="game-name">{{ $game->name }}</h3>
            <p class="developer">{{ $game->developer }}</p>
            <div class="platforms">
              @foreach($game->platforms as $platform)
                <img src="{{ asset(Config::get('site_vars.platform_url') . '/' . $platform->icon_filepath) }}" alt="{{ $platform->name }}" class="platform-icon">
              @endforeach
            </div>
          </div>
        </a>
      </div>
  @endforeach
</div>
@else
<div class="empty-game-gallery">
  <h3 class="text-light">No games found.</h3>
</div>
@endif