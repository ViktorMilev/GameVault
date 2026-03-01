{{-- TABLE CONTAINER --}}
<div class="admin-card">

    <table class="admin-table">

        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email Address</th>
                <th style="width: 80px;"></th>
            </tr>
        </thead>

        <tbody>

            @foreach($users as $user)

            <tr>

                <td>{{ $user->id }}</td>

                <td class="fw-bold">
                    {{ $user->name }}
                </td>

                <td>{{ $user->email }}</td>

                {{-- ACTION DROPDOWN --}}
                <td>

                    <div class="dropdown">
                        <button class="btn btn-icon  dropdown-toggle no-arrow" type="button" data-bs-toggle="dropdown"
                            data-bs-auto-close="true" aria-expanded="false">
                            ⋮
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a href="{{ route('admin.entities.edit', ['entity' => 'games', 'slug' => $user->id]) }}"
                                    class="dropdown-item">
                                    Edit
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('game.article', $user->id) }}" class="dropdown-item"
                                    target="_blank">
                                    View
                                </a>
                            </li>

                            <li>
                                <form method="POST"
                                    action="{{ route('admin.entities.delete', ['entity' => 'games', 'slug' => $user->id]) }}"
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