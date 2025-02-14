@extends('cms::layouts.backend')

@section('content')
    <form method="post" action="{{ route('admin.setting.save') }}" class="form-ajax">
        @component('cms::components.tabs', [
            'tabs' => [
                'general' => trans('cms::app.general'),
                'shop' => trans('ecomm::content.shop'),
                'multi_currency' => trans('ecomm::content.multi_currency'),
            ]
        ])
            @slot('tab_general')
                @include('ecomm::backend.setting.components.setting.general')
            @endslot

            @slot('tab_shop')
                @include('ecomm::backend.setting.components.setting.shop')
            @endslot

            @slot('tab_multi_currency')
                @include('ecomm::backend.setting.components.setting.multi_currency')
            @endslot
        @endcomponent

        <button type="submit" class="btn btn-success">{{__('Save Changes')}}</button>
    </form>
@endsection
