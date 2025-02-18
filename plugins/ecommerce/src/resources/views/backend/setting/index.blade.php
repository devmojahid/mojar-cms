@extends('cms::layouts.backend')

@section('content')
    <form method="post" action="{{ route('admin.setting.save') }}" class="form-ajax">
        @component('cms::components.tabs', [
            'tabs' => [
                'general' => [
                    'label' => trans('cms::app.general'),
                    'icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-apps"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M4 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M14 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M14 7l6 0" /><path d="M17 4l0 6" /></svg>'
                ],
                'shop' => trans('ecomm::content.shop'),
                'multi_currency' => trans('ecomm::content.multi_currency'),
            ],
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

        <button type="submit" class="btn btn-tabler">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path><path d="M14 4l0 4l-6 0l0 -4"></path> </svg>
            </span>
            {{ __('Save Changes') }}
        </button>
    </form>
@endsection
