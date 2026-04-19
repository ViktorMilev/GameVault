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

        <h2 class="mb-4 page-header">{{ $t['admin']['entity_edit_page']['page_headers']['game_platform'] }}</h2>

        <div class="card card-custom p-4" style="background-color: var(--darkgray);">

            <form method="POST" action="{{ route('admin.entities.update', ['entity' => $entity, 'slug' => $slug]) }}" enctype="multipart/form-data">
                @csrf

                <h4 class="section-title">{{ $t['admin']['entity_edit_page']['sections']['basic_info'] }}</h4>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">{{ $t['admin']['entity_edit_page']['fields']['title'] }}</label>
                        <input type="text" name="name" class="form-control" value="{{ $entityData->name ?? 'N/A' }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ $t['admin']['entity_edit_page']['fields']['slug'] }}</label>
                        <input type="text" name="slug" class="form-control" value="{{ $entityData->slug ?? 'N/A' }}">
                    </div>
                </div>

                <h4 class="section-title">{{ $t['admin']['entity_edit_page']['sections']['icon_image'] }}</h4>

                @if($entityData->avatar ?? false)
                    <div class="mb-3">
                        <label class="form-label">{{ $t['admin']['entity_edit_page']['fields']['current_avatar'] }}</label>
                        <div>
                            <img src="{{ asset('storage/' . $entityData->avatar) }}" alt="Profile Image" class="img-thumbnail" style="max-width: 150px;">
                        </div>
                    </div>
                @endif

                <div class="mb-4">
                    <label class="form-label">{{ $t['admin']['entity_edit_page']['fields']['upload_avatar'] }}</label>
                    <input type="file" class="form-control" name="avatar" accept="image/*">
                    <small class="form-text text-muted">Leave empty to keep current image. Supported formats: JPG, PNG, GIF.</small>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.categories.index', ['entity' => 'game_platforms']) }}" class="btn btn-secondary">{{ $t['admin']['entity_edit_page']['actions']['cancel'] }}</a>
                    <button type="submit" class="btn btn-purple px-4">{{ $t['admin']['entity_edit_page']['actions']['save'] }}</button>
                </div>

            </form>

        </div>

</div>