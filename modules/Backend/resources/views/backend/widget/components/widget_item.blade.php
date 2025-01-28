<div class="widget-block card mb-3">
    <div class="card-body widget-block-body">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h6 class="widget-title font-weight-bold mb-1">
                    {{-- <i class="fa fa-puzzle-piece text-primary me-1"></i> --}}
                    <span>
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-category-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4h6v6h-6zm10 0h6v6h-6zm-10 10h6v6h-6zm10 3h6m-3 -3v6" /></svg>
                    </span>
                    {{ $widget->get('label') }}
                </h6>
                <p class="widget-description text-muted mb-0">{{ $widget->get('description') }}</p>
            </div>
            <div>
                <!-- Toggler for the collapsible form -->
                <a 
                  href="javascript:void(0)" 
                  class="dropdown-action"
                  title="{{ __('Add this widget to sidebars') }}"
                >
                    <span>
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-copy-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path stroke="none" d="M0 0h24v24H0z" /><path d="M7 9.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" /><path d="M4.012 16.737a2 2 0 0 1 -1.012 -1.737v-10c0 -1.1 .9 -2 2 -2h10c.75 0 1.158 .385 1.5 1" /><path d="M11 14h6" /><path d="M14 11v6" /></svg>
                    </span>
                </a>
            </div>
        </div>
    </div>

    <!-- Collapsible Add-to-Sidebar Section -->
    <div 
      class="sidebar-blocks box-hidden px-3 py-2" 
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
                <button type="submit" class="btn btn-tabler">
                    <span>
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>    
                    </span>
                    {{ trans('cms::app.add_widget') }}
                </button>
            </div>
        </form>
    </div>
</div>