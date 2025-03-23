@extends('cms::layouts.backend')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="{{ isset($version) ? route('admin.dev-tool.package-versions.update', $version->id) : route('admin.dev-tool.package-versions.store') }}" class="form-ajax" enctype="multipart/form-data">
                @csrf
                @if(isset($version))
                    @method('PUT')
                @endif

                <div class="card">
                    <div class="card-header">
                        <div class="card-title">{{ $title }}</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label required">{{ __('Package Type') }}</label>
                                    <select name="package_type" class="form-control" required>
                                        <option value="plugin" {{ (isset($version) && $version->package_type == 'plugin') || old('package_type') == 'plugin' ? 'selected' : '' }}>{{ __('Plugin') }}</option>
                                        <option value="theme" {{ (isset($version) && $version->package_type == 'theme') || old('package_type') == 'theme' ? 'selected' : '' }}>{{ __('Theme') }}</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label required">{{ __('Package Name') }}</label>
                                    <input type="text" name="package_name" class="form-control" value="{{ $version->package_name ?? old('package_name') }}" required>
                                    <small class="form-text text-muted">{{ __('The identifier name of the plugin or theme (e.g., "my-plugin" or "my-theme").') }}</small>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label required">{{ __('Version') }}</label>
                                    <input type="text" name="version" class="form-control" value="{{ $version->version ?? old('version') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">{{ __('Description') }}</label>
                                    <textarea name="description" class="form-control" rows="3">{{ $version->description ?? old('description') }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">{{ __('Required CMS Version') }}</label>
                                    <input type="text" name="requires_cms_version" class="form-control" value="{{ $version->requires_cms_version ?? old('requires_cms_version') }}" placeholder="1.0.0 or above">
                                    <small class="form-text text-muted">{{ __('The minimum CMS version required for this package version to work.') }}</small>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">{{ __('Download URL') }}</label>
                                    <input type="url" name="download_url" class="form-control" value="{{ $version->download_url ?? old('download_url') }}" placeholder="https://...">
                                    <small class="form-text text-muted">{{ __('External URL where the update package can be downloaded from. Leave empty to use local file.') }}</small>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">{{ __('Update Package') }}</label>
                                    <input type="file" name="package_file" class="form-control" accept=".zip">
                                    @if(isset($version) && $version->file_path)
                                        <div class="mt-2">
                                            <span class="badge bg-success">{{ __('Current file:') }} {{ basename($version->file_path) }}</span>
                                        </div>
                                    @endif
                                    <small class="form-text text-muted">{{ __('ZIP file containing the update package. Only required if no download URL is provided.') }}</small>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">{{ __('Changelog') }}</label>
                                    <textarea name="changelog" class="form-control" rows="5">{{ $version->changelog ?? old('changelog') }}</textarea>
                                    <small class="form-text text-muted">{{ __('What has changed in this version.') }}</small>
                                </div>

                                @if(isset($version))
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ isset($version) && $version->is_active ? 'checked' : '' }}>
                                        <label class="form-check-label">{{ __('Active') }}</label>
                                    </div>
                                    <small class="form-text text-muted">{{ __('Only active versions can be used for updates.') }}</small>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <div class="d-flex">
                            <a href="{{ route('admin.dev-tool.package-versions.index') }}" class="btn btn-link">{{ __('Cancel') }}</a>
                            <button type="submit" class="btn btn-primary ms-auto">{{ __('Save') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
