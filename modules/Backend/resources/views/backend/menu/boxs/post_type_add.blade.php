<ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
        <a class="nav-link active"
           id="box-{{ $key }}-latest-label"
           href="#box-{{ $key }}-latest-tab"
           data-toggle="tab"
           role="tab">
           {{ trans('cms::app.latest') }}
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link"
           id="box-{{ $key }}-search-label"
           href="#box-{{ $key }}-search-tab"
           data-toggle="tab"
           role="tab">
           {{ trans('cms::app.search') }}
        </a>
    </li>
</ul>

<div class="tab-content">
    <!-- Latest -->
    <div class="tab-pane fade p-3 show active"
         id="box-{{ $key }}-latest-tab"
         role="tabpanel"
         aria-labelledby="box-{{ $key }}-latest-label">
        @foreach($items ?? [] as $item)
            <div class="form-check mt-1">
                <input class="form-check-input select-all-{{ $key }}"
                       type="checkbox"
                       name="items[]"
                       value="{{ $item->id }}"
                       id="latest-item-{{ $key }}-{{ $item->id }}">
                <label class="form-check-label"
                       for="latest-item-{{ $key }}-{{ $item->id }}">
                    {{ $item->name ?? $item->title }}
                </label>
            </div>
        @endforeach

        <div class="row mt-3">
            <div class="col-md-6">
                <div class="form-check">
                    <input class="form-check-input select-all-checkbox"
                           type="checkbox"
                           id="select-all-latest-{{ $key }}"
                           data-select="select-all-{{ $key }}">
                    <label class="form-check-label"
                           for="select-all-latest-{{ $key }}">
                        {{ trans('cms::app.select_all') }}
                    </label>
                </div>
            </div>
        </div>
    </div>

    <!-- Search -->
    <div class="tab-pane fade p-3"
         id="box-{{ $key }}-search-tab"
         role="tabpanel"
         aria-labelledby="box-{{ $key }}-search-label">
        <input class="form-control menu-box-post-type-search"
               type="text"
               placeholder="{{ trans('cms::app.search') }}"
               data-post_type="{{ $postType->get('key') }}"
               data-key="{{ $key }}">

        <div class="box-tab-search-result mt-3"></div>

        <div class="row mt-3">
            <div class="col-md-6">
                <div class="form-check">
                    <input class="form-check-input select-all-checkbox"
                           type="checkbox"
                           id="select-all-search-{{ $key }}"
                           data-select="select-all-search-{{ $key }}">
                    <label class="form-check-label"
                           for="select-all-search-{{ $key }}">
                        {{ trans('cms::app.select_all') }}
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>



{{-- <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="box-{{ $key }}-latest-label" href="#box-{{ $key }}-latest-tab" data-toggle="tab">{{ trans('cms::app.latest') }}</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" id="box-{{ $key }}-search-label" href="#box-{{ $key }}-search-tab" data-toggle="tab">{{ trans('cms::app.search') }}</a>
    </li>
</ul>

<div class="tab-content">
    <div class="tab-pane fade p-2 active show" id="box-{{ $key }}-latest-tab" role="tabpanel" aria-labelledby="box-{{ $key }}-latest-label">
        @foreach($items ?? [] as $item)
            <div class="form-check mt-1">
                <label class="form-check-label">
                    <input class="form-check-input select-all-{{ $key }}" type="checkbox" name="items[]" value="{{ $item->id }}">
                    {{ $item->name ?? $item->title }}
                </label>
            </div>
        @endforeach

        <div class="row mt-3">
            <div class="col-md-6">
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input select-all-checkbox" type="checkbox" data-select="select-all-{{ $key }}">
                        {{ trans('cms::app.select_all') }}
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="tab-pane fade p-2" id="box-{{ $key }}-search-tab" role="tabpanel" aria-labelledby="box-{{ $key }}-search-label">
        <input class="form-control menu-box-post-type-search" type="text" placeholder="{{ trans('cms::app.search') }}" data-post_type="{{ $postType->get('key') }}" data-key="{{ $key }}">

        <div class="box-tab-search-result mt-2">

        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input select-all-checkbox" type="checkbox" data-select="select-all-search-{{ $key }}">
                        {{ trans('cms::app.select_all') }}
                    </label>
                </div>
            </div>
        </div>

    </div>

</div> --}}
