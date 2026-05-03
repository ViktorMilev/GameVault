<div class="content flex-grow-1">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <h2 class="mb-4 page-header">{{ $t['admin']['entity_create_page']['page_headers']['game'] }}</h2>

    <div class="card card-custom p-4" style="background-color: var(--darkgray);">
        <form method="POST" action="{{ route('admin.entities.store', ['entity' => $entity, 'slug' => $slug]) }}" enctype="multipart/form-data">
            @csrf

            <h4 class="section-title">{{ $t['admin']['entity_edit_page']['sections']['main'] }}</h4>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">{{ $t['admin']['entity_edit_page']['fields']['title'] }}</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="Title of the game">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">{{ $t['admin']['entity_edit_page']['fields']['slug'] }}</label>
                    <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}" placeholder="URL-friendly identifier (e.g. 'my-awesome-game')">
                    @error('slug')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">{{ $t['admin']['entity_edit_page']['fields']['short_description'] }}</label>
                <textarea name="short_description" rows="3" class="form-control @error('short_description') is-invalid @enderror" placeholder="Short description...">{{ old('short_description') }}</textarea>
                @error('short_description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">{{ $t['admin']['entity_edit_page']['fields']['description'] }}</label>
                <textarea name="description" rows="6" class="form-control @error('description') is-invalid @enderror" placeholder="Longer detailed description of the game...">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">{{ $t['admin']['entity_edit_page']['fields']['developer'] }}</label>
                    <input type="text" name="developer" class="form-control @error('developer') is-invalid @enderror" value="{{ old('developer') }}" placeholder="Developer of the game">
                    @error('developer')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">{{ $t['admin']['entity_edit_page']['fields']['publisher'] }}</label>
                    <input type="text" name="publisher" class="form-control @error('publisher') is-invalid @enderror" value="{{ old('publisher') }}" placeholder="Publisher of the game">
                    @error('publisher')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <h4 class="section-title">{{ $t['admin']['entity_edit_page']['sections']['categorization'] }}</h4>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">{{ $t['admin']['entity_edit_page']['fields']['category'] }}</label>
                    <select class="form-select @error('category_id') is-invalid @enderror" name="category_id">
                        <option value="">Select category</option>
                        @foreach($gameCategories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label">{{ $t['admin']['entity_edit_page']['fields']['subcategory'] }}</label>
                    <select class="form-select @error('subcategory_id') is-invalid @enderror" name="subcategory_id">
                        <option value="">Select subcategory</option>
                        @foreach($gameSubcategories as $subcategory)
                            <option value="{{ $subcategory->id }}" {{ old('subcategory_id') == $subcategory->id ? 'selected' : '' }}>
                                {{ $subcategory->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('subcategory_id')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label">{{ $t['admin']['entity_edit_page']['fields']['platforms'] }}</label>
                    <select class="form-select @error('platforms') is-invalid @enderror" name="platforms[]" multiple>
                        @foreach($gamePlatforms as $platform)
                            <option value="{{ $platform->id }}" {{ collect(old('platforms', []))->contains($platform->id) ? 'selected' : '' }}>
                                {{ $platform->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('platforms')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <h4 class="section-title">{{ $t['admin']['entity_edit_page']['sections']['media'] }}</h4>

            <div class="mb-3">
                <label class="form-label">{{ $t['admin']['entity_edit_page']['fields']['thumbnail_image'] }}</label>
                <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" name="thumbnail">
                @error('thumbnail')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">{{ $t['admin']['entity_edit_page']['fields']['gallery_images'] }}</label>
                <input type="file" class="form-control @error('gallery') is-invalid @enderror" name="gallery[]" multiple>
                @error('gallery')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">{{ $t['admin']['entity_edit_page']['fields']['trailer_url'] }}</label>
                <input type="text" class="form-control @error('trailer_url') is-invalid @enderror" name="trailer_url" value="{{ old('trailer_url') }}" placeholder="URL of the game's trailer video (e.g. YouTube link)">
                @error('trailer_url')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <h4 class="section-title">{{ $t['admin']['entity_edit_page']['sections']['seo'] }}</h4>

            <div class="mb-3">
                <label class="form-label">{{ $t['admin']['entity_edit_page']['fields']['seo_title'] }}</label>
                <input type="text" class="form-control @error('meta_title') is-invalid @enderror" name="meta_title" value="{{ old('meta_title') }}" placeholder="Optional SEO title (if different from main title)">
                @error('meta_title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">{{ $t['admin']['entity_edit_page']['fields']['seo_description'] }}</label>
                <textarea rows="3" class="form-control @error('meta_description') is-invalid @enderror" name="meta_description" placeholder="Optional SEO description">{{ old('meta_description') }}</textarea>
                @error('meta_description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.categories.index', ['entity' => 'games']) }}" class="btn btn-secondary">{{ $t['admin']['entity_edit_page']['actions']['cancel'] }}</a>
                <button type="submit" class="btn btn-purple px-4">{{ $t['admin']['entity_edit_page']['actions']['save'] }}</button>
            </div>
        </form>
    </div>
</div>
