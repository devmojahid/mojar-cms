@extends('cms::layouts.backend')

@section('content')
<div class="widgets-management-page">
    {{-- Page Header / Title --}}
    <div class="page-header mb-4">
        <h2 class="page-title">{{ __('Widgets Management') }}</h2>
        <p class="text-muted">{{ __('Easily manage and organize your widgets across various sidebars.') }}</p>
    </div>

    <div class="row" id="widget-container">
        <div class="col-12 col-lg-4">
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
