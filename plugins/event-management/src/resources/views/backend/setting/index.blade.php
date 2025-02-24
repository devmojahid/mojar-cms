@extends('cms::layouts.backend')

@section('content')
    <form method="post" action="{{ route('admin.setting.save') }}" class="form-ajax">
        @component('cms::components.tabs', [
            'tabs' => [
                'general' => trans('cms::app.general')
            ]
        ])
            @slot('tab_general')
                @include('evman::backend.setting.components.setting.general')
            @endslot
        @endcomponent

        <button type="submit" class="btn btn-success">{{__('Save Changes')}}</button>
    </form>
@endsection
