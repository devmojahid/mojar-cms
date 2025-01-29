<div class="card card-menu-items mb-2" id="menu-box-{{ $key }}">
    <div class="card-header card-header-flex">
        <div class="d-flex flex-column justify-content-center">
            <h5 class="mb-0 text-capitalize">{{ $label }}</h5>
        </div>

        <div class="ml-auto d-flex align-items-stretch">
            <a href="javascript:void(0)" class="card-menu-show"><i class="fa fa-sort-down"></i></a>
        </div>
    </div>

    <div class="card-body @if($hidden ?? true) box-hidden @endif">
        <form action="{{ route('admin.menu.add-item') }}" method="post" class="form-menu-block">
            {!! $slot ?? '' !!}

            <input type="hidden" name="key" value="{{ $key }}">
            <input type="hidden" name="reload_after_save" value="0">

            <button type="submit" class="btn btn-tabler mt-2 px-3 btn-sm">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                {{ trans('cms::app.add_to_menu') }}
            </button>
        </form>
    </div>
</div>