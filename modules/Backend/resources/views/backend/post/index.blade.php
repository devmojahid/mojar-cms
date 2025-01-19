@extends('cms::layouts.backend')

@section('breadcrumb-right')
<div class="col-auto mb-3">
    <div class="btn-group float-right">
        @if($canCreate)
        <a href="{{ $linkCreate }}" class="btn btn-tabler">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M12 5l0 14" />
                <path d="M5 12l14 0" />
            </svg>
                {{ trans('cms::app.add_new') }}</a>
        @endif

        @do_action("post_type.{$setting->get('key')}.btn_group")
    </div>
</div>
@endsection

@section('content')
    {{ $dataTable->render($linkCreate) }}

    @do_action("post_type.{$setting->get('key')}.index")

@endsection