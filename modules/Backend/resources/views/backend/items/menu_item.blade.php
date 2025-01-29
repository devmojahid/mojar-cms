{{-- @php
$data = $item->getAttributes();
$register = $item->menuBox();
$menuBox = $register ? $register->get('menu_box') : false;
$view = $menuBox ? $menuBox->editView($item) : false;
@endphp

<li class="dd-item menu-item @if(!$register) disabled @endif"
    @foreach($data as $key => $val)
        @if(!is_array($val))
            data-{{ $key }}="{{ $val }}"
        @endif
    @endforeach
>
    <div class="dd-handle menu-item-handle">
        <div class="menu-item-content">
            <span class="menu-item-title">{{ $data['label'] }}</span>
            @if($register)
                <button type="button" class="btn btn-link btn-sm dd-nodrag show-menu-edit p-0" 
                    title="{{ trans('cms::app.edit') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon">
                        <path d="M7 7l5 5l5 -5"></path>
                        <path d="M7 13l5 5l5 -5"></path>
                    </svg>
                </button>
            @endif
        </div>
    </div>

    <div class="menu-item-edit box-hidden">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                @if(!empty($view))
                    {!! $view !!}
                @endif

                <div class="form-group mb-3">
                    <label class="form-label">{{ trans('cms::app.target') }}</label>
                    <select class="form-select menu-data" data-name="target">
                        <option value="_self" @if($item->target == '_self') selected @endif>
                            {{ trans('cms::app.target_self') }}
                        </option>
                        <option value="_blank" @if($item->target == '_blank') selected @endif>
                            {{ trans('cms::app.target_blank') }}
                        </option>
                    </select>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <button type="button" class="btn btn-danger btn-sm delete-menu-item">
                        {{ trans('cms::app.delete') }}
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm close-menu-item">
                        {{ trans('cms::app.cancel') }}
                    </button>
                </div>
            </div>
        </div>
    </div>

    @if(!empty($children))
        <ol class="dd-list">
            @foreach($children as $child)
                {!! $builder->buildItem($child) !!}
            @endforeach
        </ol>
    @endif
</li>
 --}}

 @php
$data = $item->getAttributes();
$register = $item->menuBox();
$menuBox = $register ? $register->get('menu_box') : false;
$view = $menuBox ? $menuBox->editView($item) : false;
@endphp
<li
    class="dd-item @if(!$register) disabled @endif"
    @foreach($data as $key => $val)
        @if(!is_array($val))
            data-{{ $key }}="{{ $val }}"
        @endif
    @endforeach
>
    <div class="dd-handle">
        <span>{{ $data['label'] }}</span>
        <a href="javascript:void(0)" class="dd-nodrag @if($register) show-menu-edit @endif">
            <i class="fa fa-sort-down"></i>
        </a>
   
    </div>

    <div class="form-item-edit box-hidden">
        @if(!empty($view))
            {!! $view !!}
        @endif

        <div class="form-group">
            <label class="col-form-label">{{ trans('cms::app.target') }}</label>
            <select class="form-control menu-data" data-name="target">
                <option value="_self" @if($item->target == '_self') selected @endif>{{ trans('cms::app.target_self') }}</option>
                <option value="_blank" @if($item->target == '_blank') selected @endif>{{ trans('cms::app.target_blank') }}</option>
            </select>
        </div>

        <a href="javasctipt:void(0)" class="text-danger delete-menu-item">{{ trans('cms::app.delete') }}</a>
        <a href="javasctipt:void(0)" class="text-info close-menu-item">{{ trans('cms::app.cancel') }}</a>
    </div>

    @if(!empty($children))
        <ol class="dd-list">
        @foreach($children as $child)
            {!! $builder->buildItem($child) !!}
        @endforeach
        </ol>
    @endif

</li> 