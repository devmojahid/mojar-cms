<div class="widget-block card mb-3">
    <div class="card-body widget-block-body">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h6 class="widget-title font-weight-bold mb-1">
                    <i class="fa fa-puzzle-piece text-primary me-1"></i>
                    {{ $widget->get('label') }}
                </h6>
                <p class="widget-description text-muted mb-0">{{ $widget->get('description') }}</p>
            </div>
            <div>
                <!-- Toggler for the collapsible form -->
                <a 
                  href="javascript:void(0)" 
                  class="dropdown-action"
                  data-bs-toggle="collapse" 
                  data-bs-target="#widget-add-sidebar-{{ $key }}" 
                  aria-expanded="false"
                  aria-controls="widget-add-sidebar-{{ $key }}"
                  title="{{ __('Add this widget to sidebars') }}"
                >
                    <i class="fa fa-plus-circle fa-2x"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Collapsible Add-to-Sidebar Section -->
    <div 
      class="collapse sidebar-blocks box-hidden px-3 py-2" 
      id="widget-add-sidebar-{{ $key }}"
    >
        <form action="" method="get" class="form-add-widget">
            <div class="list-group mt-3">
                @foreach($sidebars as $sidebarKey => $sidebar)
                    <label 
                      class="list-group-item list-group-item-action widget-sidebar-item d-flex align-items-center justify-content-between"
                    >
                        {{ trans('cms::app.add_to', ['name' => $sidebar->get('label')]) }}
                        <input type="checkbox" name="sidebars[]" value="{{ $sidebarKey }}" class="box-hidden">
                    </label>
                @endforeach
            </div>

            <div class="text-center my-3">
                <input type="hidden" name="widget" value="{{ $key }}">
                <button type="submit" class="btn btn-success btn-sm">
                    <i class="fa fa-plus"></i> {{ trans('cms::app.add_widget') }}
                </button>
            </div>
        </form>
    </div>
</div>


{{-- <div class="widget-block mb-2">
    <div class="widget-block-body">
        <a href="javascript:void(0)" class="dropdown-action"><i class="fa fa-sort-down fa-2x"></i></a>
        <div class="widget-title">{{ $widget->get('label') }}</div>
        <div class="widget-description">{{ $widget->get('description') }}</div>
    </div>

    <div class="sidebar-blocks box-hidden">
        <form action="" method="get" class="form-add-widget">
            <div class="list-group mt-3">
                @foreach($sidebars as $sidebarKey => $sidebar)
                    <a href="javascript:void(0)" class="list-group-item rounded-0 widget-sidebar-item">
                        <span></span> {{ trans('cms::app.add_to', ['name' => $sidebar->get('label')]) }}
                        <input type="checkbox" name="sidebars[]" value="{{ $sidebarKey }}" class="box-hidden">
                    </a>
                @endforeach
            </div>

            <div class="text-center mb-2">
                <input type="hidden" name="widget" value="{{ $key }}">

                <button type="submit" class="btn btn-success btn-sm mt-2">{{ trans('cms::app.add_widget') }}</button>
            </div>
        </form>

    </div>

</div> --}}