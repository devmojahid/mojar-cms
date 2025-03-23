@extends('cms::layouts.backend')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h5>{{ $title }}</h5>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form method="post" 
                        action="{{ $model->id ? route('admin.dev-tool.marketplace-plugins.update', $model->id) : route('admin.dev-tool.marketplace-plugins.store') }}" 
                        class="form-ajax"
                        enctype="multipart/form-data">
                        @csrf
                        
                        @if($model->id)
                            @method('PUT')
                        @endif
                        
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="col-form-label" for="name">{{ trans('dev-tool::content.name') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $model->name }}" required>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-form-label" for="title">{{ trans('cms::app.title') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ $model->title }}" required>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-form-label" for="description">{{ trans('cms::app.description') }}</label>
                                    <textarea class="form-control" id="description" name="description" rows="4">{{ $model->description }}</textarea>
                                </div>
                                
                                <div class="form-group mb-4">
                                    <label class="col-form-label">{{ trans('Plugin Package') }}</label>
                                    
                                    <div class="mb-3">
                                        <label class="col-form-label" for="url">{{ trans('Download URL') }}</label>
                                        <input type="url" class="form-control" id="url" name="url" value="{{ $model->url }}">
                                        <small class="form-text text-muted">{{ __('External URL where the plugin package can be downloaded from. Leave empty to use local file.') }}</small>
                                    </div>
                                    
                                    <div>
                                        <label class="col-form-label" for="package_file">{{ trans('Upload Package') }}</label>
                                        <input type="file" class="form-control" id="package_file" name="package_file" accept=".zip">
                                        @if($model->file_path)
                                            <div class="mt-2">
                                                <span class="badge bg-success">{{ __('Current file:') }} {{ basename($model->file_path) }}</span>
                                            </div>
                                        @endif
                                        <small class="form-text text-muted">{{ __('ZIP file containing the plugin package. Only required if no download URL is provided.') }}</small>
                                    </div>
                                </div>
                                
                                <div class="form-group mb-4">
                                    <label class="col-form-label">{{ trans('Thumbnail') }}</label>
                                    
                                    <div class="mb-3">
                                        <label class="col-form-label" for="thumbnail">{{ trans('Thumbnail URL') }}</label>
                                        <input type="url" class="form-control" id="thumbnail" name="thumbnail" value="{{ $model->thumbnail }}">
                                        <small class="form-text text-muted">{{ __('External URL for the thumbnail image. Leave empty to use local file.') }}</small>
                                    </div>
                                    
                                    <div>
                                        <label class="col-form-label" for="thumbnail_file">{{ trans('Upload Thumbnail') }}</label>
                                        <input type="file" class="form-control" id="thumbnail_file" name="thumbnail_file" accept="image/*">
                                        @if($model->thumbnail_path)
                                            <div class="mt-2">
                                                <span class="badge bg-success">{{ __('Current file:') }} {{ basename($model->thumbnail_path) }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="form-group mb-4">
                                    <label class="col-form-label">{{ trans('Banner') }}</label>
                                    
                                    <div class="mb-3">
                                        <label class="col-form-label" for="banner">{{ trans('Banner URL') }}</label>
                                        <input type="url" class="form-control" id="banner" name="banner" value="{{ $model->banner }}">
                                        <small class="form-text text-muted">{{ __('External URL for the banner image. Leave empty to use local file.') }}</small>
                                    </div>
                                    
                                    <div>
                                        <label class="col-form-label" for="banner_file">{{ trans('Upload Banner') }}</label>
                                        <input type="file" class="form-control" id="banner_file" name="banner_file" accept="image/*">
                                        @if($model->banner_path)
                                            <div class="mt-2">
                                                <span class="badge bg-success">{{ __('Current file:') }} {{ basename($model->banner_path) }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>{{ trans('cms::app.status') }}</h5>
                                    </div>
                                    
                                    <div class="card-body">
                                        <div class="form-check mb-3">
                                            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ $model->is_active ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active">{{ trans('cms::app.active') }}</label>
                                        </div>
                                        
                                        <div class="form-check mb-3">
                                            <input type="checkbox" class="form-check-input" id="is_featured" name="is_featured" value="1" {{ $model->is_featured ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_featured">{{ trans('Featured') }}</label>
                                        </div>
                                        
                                        <div class="form-check mb-3">
                                            <input type="checkbox" class="form-check-input" id="is_paid" name="is_paid" value="1" {{ $model->is_paid ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_paid">{{ trans('Paid') }}</label>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-form-label" for="price">{{ trans('cms::app.price') }}</label>
                                            <input type="text" class="form-control" id="price" name="price" value="{{ $model->price }}">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-form-label" for="sort_order">{{ trans('cms::app.sort_order') }}</label>
                                            <input type="number" class="form-control" id="sort_order" name="sort_order" value="{{ $model->sort_order ?? 0 }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-3">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-save"></i> {{ trans('cms::app.save') }}
                            </button>
                            
                            <a href="{{ route('admin.dev-tool.marketplace-plugins.index') }}" class="btn btn-secondary">
                                <i class="fa fa-times"></i> {{ trans('cms::app.cancel') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection 