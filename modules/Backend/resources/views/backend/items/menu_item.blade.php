@php
$data = $item->getAttributes();
$register = $item->menuBox();
$menuBox = $register ? $register->get('menu_box') : false;
$view = $menuBox ? $menuBox->editView($item) : false;
@endphp

<li class="dd-item @if(!$register) disabled @endif"
    @foreach($data as $key => $val)
        @if(!is_array($val))
            data-{{ $key }}="{{ $val }}"
        @endif
    @endforeach
>
    <!-- Draggable Handle -->
    <div class="dd-handle d-flex align-items-center justify-content-between">
        <span>{{ $data['label'] }}</span>
        @if($register)
            <a href="javascript:void(0)"
               class="dd-nodrag show-menu-edit ml-2"
               title="{{ trans('cms::app.edit') }}">
               <i class="fa fa-sort-down"></i>
            </a>
        @endif
    </div>

    <!-- Edit Panel -->
    <div class="form-item-edit box-hidden p-3 border mt-1">
        @if(!empty($view))
            {!! $view !!}
        @endif

        <div class="form-group mb-3">
            <label class="col-form-label">{{ trans('cms::app.target') }}</label>
            <select class="form-control menu-data" data-name="target">
                <option value="_self" @if($item->target == '_self') selected @endif>
                    {{ trans('cms::app.target_self') }}
                </option>
                <option value="_blank" @if($item->target == '_blank') selected @endif>
                    {{ trans('cms::app.target_blank') }}
                </option>
            </select>
        </div>

        <div class="d-flex justify-content-between">
            <a href="javascript:void(0)"
               class="text-danger delete-menu-item">
               {{ trans('cms::app.delete') }}
            </a>
            <a href="javascript:void(0)"
               class="text-info close-menu-item">
               {{ trans('cms::app.cancel') }}
            </a>
        </div>
    </div>
    <!-- /Edit Panel -->

    <!-- Nested Children -->
    @if(!empty($children))
        <ol class="dd-list">
            @foreach($children as $child)
                {!! $builder->buildItem($child) !!}
            @endforeach
        </ol>
    @endif
</li>


{{-- @php
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

</li> --}}