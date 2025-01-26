@component('cms::components.form', [
    'method' => 'post',
    'action' => route('admin.reading.save'),
])
    <div class="card">
        <div class="card-header bg-transparent justify-content-end align-items-center">
            <div class="actions-buttons">
                <button type="submit" class="btn btn-tabler me-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" <svg
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                        <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M14 4l0 4l-6 0l0 -4" />
                    </svg>
                    {{ trans('cms::app.save') }}
                </button>
                <button type="reset" class="btn btn-teal cancel-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-refresh">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                        <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                    </svg>
                    {{ trans('cms::app.reset') }}
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">{{ trans('cms::app.your_homepage_displays') }}</label>
                <div class="form-details form-check">
                    <div class="form-check mb-2">
                        <label class="form-check-label">
                            <input type="radio" name="show_on_front" value="posts" class="show_on_front-change"
                                {{ get_config('show_on_front', 'posts') == 'posts' ? 'checked' : '' }}>
                            {{ trans('cms::app.your_latest_posts') }}
                        </label>
                    </div>

                    <div class="form-check mb-2">
                        <label class="form-check-label">
                            <input type="radio" name="show_on_front" value="page" class="show_on_front-change"
                                {{ get_config('show_on_front', 'posts') == 'page' ? 'checked' : '' }}>
                            {{ trans('cms::app.a_static_page') }}
                        </label>
                    </div>

                    <div class="mb-2">
                        <select name="home_page" class="form-control select-show_on_front load-pages"
                            data-placeholder="--- {{ trans('cms::app.select', ['name' => trans('cms::app.page')]) }} ---"
                            {{ get_config('show_on_front', 'posts') == 'posts' ? 'disabled' : '' }}>
                            @if ($page = jw_get_page(get_config('home_page')))
                                <option value="{{ $page->id }}">{{ $page->title }}</option>
                            @endif
                        </select>
                    </div>

                    <div class="mb-2">
                        <select name="post_page" class="form-control select-show_on_front load-pages"
                            data-placeholder="--- {{ trans('cms::app.select', ['name' => trans('cms::app.page')]) }} ---"
                            {{ get_config('show_on_front', 'posts') == 'posts' ? 'disabled' : '' }}>
                            @if ($page = jw_get_page(get_config('post_page')))
                                <option value="{{ $page->id }}">{{ $page->title }}</option>
                            @endif
                        </select>
                    </div>
                </div>
            </div>

            {{ Field::text(trans('Blog pages show at most'), 'posts_per_page', [
                'value' => get_config('posts_per_page', 12),
                'type' => 'number',
            ]) }}

            {{ Field::text(trans('Syndication feeds show the most recent'), 'posts_per_rss', [
                'value' => get_config('posts_per_rss', 10),
                'type' => 'number',
            ]) }}
        </div>
        <div class="card-footer bg-transparent mt-auto">
            <div class="row g-2 align-items-center">
                <div class="col-md-6"></div>
                <div class="col-md-6 d-flex justify-content-end">
                    <button type="submit" class="btn btn-tabler me-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                            <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                            <path d="M14 4l0 4l-6 0l0 -4" />
                        </svg>
                        {{ trans('cms::app.save') }}
                    </button>

                    <button type="reset" class="btn btn-teal cancel-button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-refresh">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                            <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                        </svg>
                        {{ trans('cms::app.reset') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
@endcomponent
