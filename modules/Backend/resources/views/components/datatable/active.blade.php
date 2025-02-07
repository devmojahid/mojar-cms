@if($row->active)
    <span class="badge bg-blue text-blue-fg">{{ trans('cms::app.active') }}</span>
@else
    <span class="badge bg-teal text-teal-fg">{{ trans('cms::app.inactive') }}</span>
@endif
