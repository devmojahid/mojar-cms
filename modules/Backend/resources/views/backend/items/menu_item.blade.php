
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
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <span class="me-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                        <path d="M9 4v16" />
                        <path d="M4 9h5" />
                        <path d="M4 14h5" />
                        <path d="M14 4v16" />
                        <path d="M15 9h4" />
                        <path d="M15 14h4" />
                    </svg>
                </span>
                <span class="widget-title">{{ $data['label'] }}</span>
            </div>
            <div class="dd-nodrag @if($register) show-menu-edit @endif">
                <a href="javascript:void(0)" 
                   class="show-item-form btn btn-icon" 
                   >
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M6 9l6 6l6 -6" />
                    </svg>
                </a>
            </div>
        </div>
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