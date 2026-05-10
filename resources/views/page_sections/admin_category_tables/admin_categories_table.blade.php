<div class="admin-card">

    {{-- TABS --}}
    <ul class="nav nav-tabs mb-3" id="entityTabs" role="tablist">

        <li class="nav-item" role="presentation">
            <button class="nav-link rounded-end-0 active"
                    id="categories-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#categories"
                    type="button"
                    role="tab">
                {{ $t['admin']['categories_index_page']['page_headers']['categories'] ?? '' }}
            </button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link rounded-start-0"
                    id="subcategories-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#subcategories"
                    type="button"
                    role="tab">
                {{ $t['admin']['categories_index_page']['page_headers']['subcategories'] ?? '' }}
            </button>
        </li>

    </ul>

    {{-- TAB CONTENT --}}
    <div class="tab-content" id="entityTabsContent">

        {{-- CATEGORIES --}}
        <div class="tab-pane fade show active"
             id="categories"
             role="tabpanel">

            <table class="admin-table w-100">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th style="width: 80px;"></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($gameCategories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>

                            <td class="fw-bold">
                                {{ $category->name }}
                            </td>

                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-icon dropdown-toggle no-arrow"
                                            data-bs-toggle="dropdown">
                                        ⋮
                                    </button>

                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a href="{{ route('admin.entities.edit', ['entity' => 'categories', 'slug' => $category->id]) }}"
                                               class="dropdown-item">
                                                {{ $t['general']['edit'] }}
                                            </a>
                                        </li>

                                        <li>
                                            <form method="POST"
                                                  action="{{ route('admin.entities.delete', ['entity' => 'categories', 'slug' => $category->id]) }}"
                                                  onsubmit="return confirm('Delete this category?')">
                                                @csrf
                                                <button type="submit" class="dropdown-item text-danger">
                                                    {{ $t['general']['delete'] }}
                                                </button>
                                            </form>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

        </div>

        {{-- SUBCATEGORIES --}}
        <div class="tab-pane fade"
             id="subcategories"
             role="tabpanel">

            <table class="admin-table w-100">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th style="width: 80px;"></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($subcategories as $sub)
                        <tr>
                            <td>{{ $sub->id }}</td>

                            <td class="fw-bold">
                                {{ $sub->name }}
                            </td>

                            <td>
                                {{ $sub->category->name ?? '—' }}
                            </td>

                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-icon dropdown-toggle no-arrow"
                                            data-bs-toggle="dropdown">
                                        ⋮
                                    </button>

                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a href="{{ route('admin.entities.edit', ['entity' => 'subcategories', 'slug' => $sub->id]) }}"
                                               class="dropdown-item">
                                                {{ $t['general']['edit'] }}
                                            </a>
                                        </li>

                                        <li>
                                            <form method="POST"
                                                  action="{{ route('admin.entities.delete', ['entity' => 'subcategories', 'slug' => $sub->id]) }}"
                                                  onsubmit="return confirm('Delete this subcategory?')">
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

    </div>

</div>