<div class="card mt-3 mb-3">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title m-0">{{ trans('cms::app.custom_seo') }}</h4>
        <button class="btn btn-primary btn-sm custom-seo">
            <span class="icon-tabler-square-rounded-plus">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M15 12h-6" />
                    <path d="M12 9v6" />
                </svg>
            </span>
            {{ trans('cms::app.custom_seo') }}
        </button>
    </div>

    <div class="card-body">
        <div class="box-custom-seo box-hidden">
            <div class="mb-3">
                <label for="meta_title" class="form-label">{{ trans('cms::app.title') }}</label>
                <input type="text" name="meta_title" id="meta_title" class="form-control" placeholder="Enter SEO title" value="{{ $data->meta_title ?? '' }}" autocomplete="off">
            </div>

            <div class="mb-3">
                <label for="meta_description" class="form-label">{{ trans('cms::app.description') }}</label>
                <textarea name="meta_description" id="meta_description" class="form-control" placeholder="Enter SEO description" rows="4" autocomplete="off">{{ $data->meta_description ?? '' }}</textarea>
            </div>
        </div>

        <div class="seo-review mt-4">
            <h5 class="text-muted d-flex align-items-center">
                <img src="https://www.google.com/favicon.ico" alt="Google Icon" width="16" height="16" class="me-2">
                {{ trans('cms::app.preview') }}
            </h5>
            <div class="review-box p-3 border rounded">
                <div class="review-title fw-bold text-truncate">{{ seo_string($data->meta_title ?? $model->title, 70) }}</div>
                <div class="review-url text-primary small text-truncate">{{ url('/post') }}/<span>{{ $model->slug }}</span></div>
                <div class="review-description small text-muted text-truncate">{{ seo_string($data->meta_description ?? $model->description, 300) }}</div>
            </div>
        </div>
    </div>
</div>
