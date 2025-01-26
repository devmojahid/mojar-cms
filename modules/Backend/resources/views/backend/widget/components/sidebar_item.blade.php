<div class="card sidebar-item mb-3" id="sidebar-{{ $item->get('key') }}">
    <form action="{{ route('admin.widget.update', [$item->get('key')]) }}" method="post" class="form-ajax">
        @method('PUT')

        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">{{ $item->get('label') }}</h5>
            <div class="right-actions">
                <!-- 
                  Instead of a direct JavaScript-driven toggle, 
                  use Bootstrap’s collapse:
                  data-bs-toggle="collapse" data-bs-target="#sidebar-collapse-{{ $item->get('key') }}"
                -->
                <a 
                  href="javascript:void(0)" 
                  class="toggle-collapse"
                  data-bs-toggle="collapse"
                  data-bs-target="#sidebar-collapse-{{ $item->get('key') }}"
                  aria-expanded="{{ !empty($show) ? 'true' : 'false' }}"
                  aria-controls="sidebar-collapse-{{ $item->get('key') }}"
                >
                    <i class="fa fa-sort-down fa-2x"></i>
                </a>
            </div>
        </div>

        <!-- Collapse Body -->
        <div 
          id="sidebar-collapse-{{ $item->get('key') }}"
          class="collapse @if(!empty($show)) show @endif"
        >
            <div class="card-body">
                <div class="dd jw-widget-builder" data-key="{{ $item->get('key') }}">
                    @php $widgets = jw_get_widgets_sidebar($item->get('key')); @endphp
                    <ol class="dd-list">
                        @foreach ($widgets as $key => $widget)
                            @php
                                $widgetData = \Juzaweb\CMS\Facades\HookAction::getWidgets($widget['widget'] ?? 'null');
                            @endphp
                            @if (empty($widgetData))
                                @continue
                            @endif

                            @component('cms::backend.widget.components.sidebar_widget_item', [
                                'widget' => $widgetData,
                                'sidebar' => $item,
                                'key' => $key,
                                'data' => $widget,
                            ])
                            @endcomponent
                        @endforeach
                    </ol>
                </div>

                <button type="submit" class="btn btn-success mt-3">
                    <i class="fa fa-save"></i> {{ trans('cms::app.save') }}
                </button>
            </div>
        </div>
    </form>
</div>


{{-- <div class="card sidebar-item" id="sidebar-{{ $item->get('key') }}">
    <form action="{{ route('admin.widget.update', [$item->get('key')]) }}" method="post" class="form-ajax">
        @method('PUT')

        <div class="card-header">
            <h5>{{ $item->get('label') }}</h5>

            <div class="text-right right-actions">
                <a href="javascript:void(0)" class="show-edit-form">
                    <i class="fa fa-sort-down fa-2x"></i>
                </a>
            </div>
        </div>

        <div class="card-body @if (empty($show)) box-hidden @endif">
            <div class="dd jw-widget-builder" data-key="{{ $item->get('key') }}">
                @php
                    $widgets = jw_get_widgets_sidebar($item->get('key'));
                @endphp
                <ol class="dd-list">
                    @foreach ($widgets as $key => $widget)
                        @php
                            $widgetData = \Juzaweb\CMS\Facades\HookAction::getWidgets($widget['widget'] ?? 'null');
                        @endphp

                        @if (empty($widgetData))
                            @continue
                        @endif

                        @component('cms::backend.widget.components.sidebar_widget_item', [
                            'widget' => $widgetData,
                            'sidebar' => $item,
                            'key' => $key,
                            'data' => $widget,
                        ])
                        @endcomponent
                    @endforeach
                </ol>
            </div>

            <button type="submit" class="btn btn-success">
                <i class="fa fa-save"></i> {{ trans('cms::app.save') }}
            </button>

        </div>
    </form>
</div> --}}
