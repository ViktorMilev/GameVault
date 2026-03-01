{{-- TABLE CONTAINER --}}
<div class="admin-card">

    <table class="admin-table">

        <thead>
            <tr>
                <th>ID</th>
                <th>Cover</th>
                <th>Name</th>
                <th>Developer</th>
                <th>Category</th>
                <th>Platforms</th>
                <th>Status</th>
                <th style="width: 80px;"></th>
            </tr>
        </thead>

        <tbody>

            @foreach($games as $game)

            <tr>

                <td>{{ $game->id }}</td>

                <td>
                    <img src="{{ asset(Config::get('site_vars.cover_url') . '/' . $game->cover_image) }}"
                        alt="{{ $game->name }}" class="game-cover-thumb">
                </td>

                <td class="fw-bold">
                    {{ $game->name }}
                </td>

                <td>
                    {{ $game->developer }}
                </td>

                <td>
                    {{ $game->category->name ?? '—' }}
                </td>

                <td>
                    @foreach($game->platforms as $platform)
                    <span class="platform-badge">
                        {{ $platform->name }}
                    </span>
                    @endforeach
                </td>

                <td>
                    <span class="status-badge active">
                        Active
                    </span>
                </td>

                {{-- ACTION DROPDOWN --}}
                <td>

                    <div class="dropdown">
                        <button class="btn btn-icon  dropdown-toggle no-arrow" type="button" data-bs-toggle="dropdown"
                            data-bs-auto-close="true" aria-expanded="false">
                            ⋮
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a href="{{ route('admin.entities.edit', ['entity' => 'games', 'slug' => $game->slug]) }}"
                                    class="dropdown-item">
                                    Edit
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('game.article', $game->slug) }}" class="dropdown-item"
                                    target="_blank">
                                    View
                                </a>
                            </li>

                            <li>
                                <form method="POST"
                                    action="{{ route('admin.entities.delete', ['entity' => 'games', 'slug' => $game->slug]) }}"
                                    onsubmit="return confirm('Delete this game?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="dropdown-item text-danger">
                                        Delete
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>