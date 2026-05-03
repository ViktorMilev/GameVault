{{-- TABLE CONTAINER --}}
<div class="admin-card">

    <table class="admin-table">

        <thead>
            <tr>
                <th>ID</th>
                <th>Cover</th>
                <th>Name</th>
                <th>Status</th>
                <th style="width: 80px;"></th>
            </tr>
        </thead>

        <tbody>

            @foreach($gamePlatforms as $platform)

            <tr>

                <td>{{ $platform->id }}</td>

                <td>
                    <img src="{{ asset(Config::get('site_vars.platform_url') . '/' . $platform->icon_filepath) }}"
                        alt="{{ $platform->name }}" class="platform-icon-thumb">
                </td>

                <td class="fw-bold">
                    {{ $platform->name }}
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
                                <a href="{{ route('admin.entities.edit', ['entity' => 'game_platforms', 'slug' => $platform->slug]) }}"
                                    class="dropdown-item">
                                    {{ $t['general']['edit'] }}
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('game.article', $platform->slug) }}" class="dropdown-item"
                                    target="_blank">
                                    {{ $t['general']['view'] }}
                                </a>
                            </li>

                            <li>
                                <form method="POST"
                                    action="{{ route('admin.entities.delete', ['entity' => 'game_platforms', 'slug' => $platform->slug]) }}"
                                    onsubmit="return confirm('Delete this game?')">
                                    @csrf

                                    <button type="submit" class="dropdown-item text-danger">
                                        {{ $t['general']['delete'] }}
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