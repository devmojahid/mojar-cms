@extends('cms::layouts.backend')

@section('content')
<div class="widgets-management-page">
    {{-- Page Header / Title --}}
    <div class="page-header mb-4">
        <h2 class="page-title">{{ __('Widgets Management') }}</h2>
        <p class="text-muted">{{ __('Easily manage and organize your widgets across various sidebars.') }}</p>
    </div>

    <div class="row" id="widget-container">
        <!-- LEFT COLUMN: Widget List + Search/Filter -->
        <div class="col-12 col-lg-4">
            <!-- FILTER / SEARCH BAR -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="form-group mb-0">
                        <label for="widget-search" class="form-label">{{ __('Search Widgets') }}</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="widget-search" 
                            placeholder="{{ __('Type to filter widgets...') }}"
                        >
                    </div>
                </div>
            </div>

            <!-- WIDGET LIST -->
            @foreach($widgets as $key => $widget)
                @component('cms::backend.widget.components.widget_item', [
                    'widget' => $widget,
                    'key' => $key,
                    'sidebars' => $sidebars
                ])
                @endcomponent
            @endforeach
        </div>

        <!-- RIGHT COLUMN: Sidebars -->
        <div class="col-12 col-lg-8">
            @php $index = 0; @endphp
            @foreach($sidebars as $key => $sidebar)
                @component('cms::backend.widget.components.sidebar_item', [
                    'item' => $sidebar,
                    'show' => $index == 0,
                ])
                @endcomponent
                @php $index++; @endphp
            @endforeach
        </div>
    </div>
</div>
@endsection