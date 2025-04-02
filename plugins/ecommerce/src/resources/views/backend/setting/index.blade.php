@extends('cms::layouts.backend')

@section('content')
    <div class="container-xl ecommerce-settings">
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="page-title">{{ $title ?? trans('ecomm::content.setting') }}</h2>
                </div>
            </div>
        </div>
        
        <form method="post" action="{{ route('admin.ecommerce.setting.save') }}" class="form-ajax">
            @component('cms::components.tabs', [
                'tabs' => [
                    'general' => [
                        'label' => trans('cms::app.general'),
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-apps"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M4 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M14 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M14 7l6 0" /><path d="M17 4l0 6" /></svg>',
                        'show' => true
                    ],
                    'shop' => [
                        'label' => trans('ecomm::content.shop'),
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path><path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path><path d="M17 17h-11v-14h-2"></path><path d="M6 5l14 1l-1 7h-13"></path></svg>',
                        'show' => true
                    ],
                    'checkout' => [
                        'label' => trans('ecomm::content.checkout'),
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-credit-card"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M3 5m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z"></path><path d="M3 10l18 0"></path><path d="M7 15l.01 0"></path><path d="M11 15l2 0"></path></svg>',
                        'show' => false
                    ],
                    'tax' => [
                        'label' => trans('ecomm::content.tax'),
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-receipt-tax"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 14l6 -6"></path><path d="M9.5 10a.5 .5 0 0 0 .5 -.5a.5 .5 0 0 0 -.5 -.5a.5 .5 0 0 0 -.5 .5a.5 .5 0 0 0 .5 .5z"></path><path d="M14.5 13.5a.5 .5 0 0 0 .5 -.5a.5 .5 0 0 0 -.5 -.5a.5 .5 0 0 0 -.5 .5a.5 .5 0 0 0 .5 .5z"></path><path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2"></path></svg>',
                        'show' => false
                    ],
                    'emails' => [
                        'label' => trans('ecomm::content.emails'),
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-mail"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z"></path><path d="M3 7l9 6l9 -6"></path></svg>',
                        'show' => false
                    ],
                    'multi_currency' => [
                        'label' => trans('ecomm::content.multi_currency'),
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-currency-dollar"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2"></path><path d="M12 3v3m0 12v3"></path></svg>',
                        'show' => true
                    ],
                ],
            ])
                @slot('tab_general')
                    @include('ecomm::backend.setting.components.setting.general')
                @endslot

                @slot('tab_shop')
                    @include('ecomm::backend.setting.components.setting.shop')
                @endslot
                
                @slot('tab_checkout')
                    @include('ecomm::backend.setting.components.setting.checkout')
                @endslot
                
                @slot('tab_tax')
                    @include('ecomm::backend.setting.components.setting.tax')
                @endslot
                
                @slot('tab_emails')
                    @include('ecomm::backend.setting.components.setting.emails')
                @endslot

                @slot('tab_multi_currency')
                    @include('ecomm::backend.setting.components.setting.multi_currency')
                @endslot
            @endcomponent

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path><path d="M14 4l0 4l-6 0l0 -4"></path></svg>
                    </span>
                    {{ __('Save Changes') }}
                </button>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            // Initialize any special controls here
        });
    </script>
@endsection
