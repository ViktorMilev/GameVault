{{-- Content --}}

<div class="content flex-grow-1">
        @if (session('success'))
            <div class="alert alert-success alert-sticky-msg1">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger alert-sticky-msg1">
                {{ session('error') }}
            </div>
        @endif

        <h2 class="mb-4 page-header">{{ $t['admin']['entity_edit_page']['page_headers']['game'] }}</h2>

        <div class="card card-custom p-4" style="background-color: var(--darkgray);">

            <form method="POST" action="{{ route('admin.entities.update', ['entity' => $entity, 'slug' => $slug]) }}" enctype="multipart/form-data">
                @csrf

                <h4 class="section-title">{{ $t['admin']['entity_edit_page']['sections']['main'] }}</h4>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">{{ $t['admin']['entity_edit_page']['fields']['title'] }}</label>
                        <input type="text" name="title" class="form-control" value="{{ $entityData->name ?? '' }}" placeholder="{{ $t['admin']['entity_edit_page']['placeholders']['title'] }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ $t['admin']['entity_edit_page']['fields']['slug'] }}</label>
                        <input type="text" name="slug" class="form-control" value="{{ $entityData->slug ?? '' }}" placeholder="{{ $t['admin']['entity_edit_page']['placeholders']['slug'] }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ $t['admin']['entity_edit_page']['fields']['short_description'] }}</label>
                    <textarea name="short_description" placeholder="{{ $t['admin']['entity_edit_page']['placeholders']['short_description'] }}" rows="3" class="form-control">{{ $entityData->short_description ?? '' }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label">{{ $t['admin']['entity_edit_page']['fields']['description'] }}</label>
                    <textarea name="description" placeholder="{{ $t['admin']['entity_edit_page']['placeholders']['description'] }}" rows="6" class="form-control">{{ $entityData->description ?? '' }}</textarea>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">{{ $t['admin']['entity_edit_page']['fields']['developer'] }}</label>
                        <input type="text" name="developer" class="form-control" value="{{ $entityData->developer ?? '' }}" placeholder="{{ $t['admin']['entity_edit_page']['placeholders']['developer'] }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ $t['admin']['entity_edit_page']['fields']['publisher'] }}</label>
                        <input type="text" name="publisher" class="form-control" value="{{ $entityData->publisher ?? '' }}" placeholder="{{ $t['admin']['entity_edit_page']['placeholders']['publisher'] }}">
                    </div>
                </div>

                <h4 class="section-title">{{ $t['admin']['entity_edit_page']['sections']['categorization'] }}</h4>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">{{ $t['admin']['entity_edit_page']['fields']['category'] }}</label>
                        <select class="form-select" name="category_id">
                            @foreach($gameCategories as $category)
                                <option value="{{ $category->id }}" {{ (isset($entityData) && $entityData->category_id == $category->id) ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">{{ $t['admin']['entity_edit_page']['fields']['subcategory'] }}</label>
                        <select class="form-select" name="subcategory_id">
                            @foreach($gameSubcategories as $subcategory)
                                <option value="{{ $subcategory->id }}" {{ (isset($entityData) && $entityData->subcategory_id == $subcategory->id) ? 'selected' : '' }}>
                                    {{ $subcategory->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">{{ $t['admin']['entity_edit_page']['fields']['platforms'] }}</label>
                        <select class="form-select" name="platforms[]" multiple>
                            @foreach($gamePlatforms as $platform)
                                <option value="{{ $platform->id }}" {{ (isset($entityData) && $entityData->platforms && $entityData->platforms->contains($platform->id)) ? 'selected' : '' }}>
                                    {{ $platform->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <h4 class="section-title">{{ $t['admin']['entity_edit_page']['sections']['media'] }}</h4>

                <div class="mb-3">
                    <label class="form-label">{{ $t['admin']['entity_edit_page']['fields']['thumbnail_image'] }}</label>
                    <input type="file" class="form-control" name="thumbnail" accept="image/*">
                </div>

                {{--
                <div class="mb-3">
                    <label class="form-label">{{ $t['admin']['entity_edit_page']['fields']['gallery_images'] }}</label>
                    <input type="file" class="form-control" name="gallery[]" accept="image/*" multiple>
                </div>
                --}}

                <div class="mb-4">
                    <label class="form-label">{{ $t['admin']['entity_edit_page']['fields']['trailer_url'] }}</label>
                    <input type="text" class="form-control" name="trailer_url" value="{{ $entityData->trailer_url ?? '' }}" placeholder="{{ $t['admin']['entity_edit_page']['placeholders']['trailer_url'] }}">
                </div>

                <h4 class="section-title">{{ $t['admin']['entity_edit_page']['sections']['seo'] }}</h4>

                <div class="mb-3">
                    <label class="form-label">{{ $t['admin']['entity_edit_page']['fields']['seo_title'] }}</label>
                    <input type="text" class="form-control" name="seo_title" value="{{ $entityData->meta_title ?? '' }}" placeholder="{{ $t['admin']['entity_edit_page']['placeholders']['seo_title'] }}">
                </div>

                <div class="mb-4">
                    <label class="form-label">{{ $t['admin']['entity_edit_page']['fields']['seo_description'] }}</label>
                    <textarea rows="3" class="form-control" name="meta_description" placeholder="{{ $t['admin']['entity_edit_page']['placeholders']['seo_description'] }}">{{ $entityData->meta_description ?? '' }}</textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.categories.index', ['entity' => 'games']) }}" class="btn btn-secondary">{{ $t['admin']['entity_edit_page']['actions']['cancel'] }}</a>
                    <button type="submit" class="btn btn-purple px-4">{{ $t['admin']['entity_edit_page']['actions']['save'] }}</button>
                </div>

            </form>

        </div>

</div>