<div class="card sidebar-item mb-3" id="sidebar-{{ $item->get('key') }}">
    <form action="{{ route('admin.widget.update', [$item->get('key')]) }}" method="post" class="form-ajax">
        @method('PUT')

        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">{{ $item->get('label') }}</h5>
            <div class="right-actions">
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

                <button type="submit" class="btn btn-tabler mt-3">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path><path d="M14 4l0 4l-6 0l0 -4"></path> </svg>
                    </span>
                    {{ trans('cms::app.save') }}
                </button>
            </div>
        </div>
    </form>
</div>
