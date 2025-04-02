@extends('cms::layouts.backend')

@section('content')
    <div class="container-xl event-settings">
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="page-title">{{ $title ?? trans('evman::content.setting') }}</h2>
                </div>
            </div>
        </div>
        
        <form method="post" action="{{ route('admin.event-management.setting.save') }}" class="form-ajax">
            @component('cms::components.tabs', [
                'tabs' => [
                    'general' => trans('cms::app.general')
                ]
            ])
                @slot('tab_general')
                    @include('evman::backend.setting.components.setting.general')
                @endslot
                
                @slot('tab_tickets')
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">{{ __('Configure ticket settings and options') }}</p>
                            <!-- Additional ticket settings can be added here -->
                        </div>
                    </div>
                @endslot
                
                @slot('tab_notifications')
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">{{ __('Configure notification templates and settings') }}</p>
                            <!-- Additional notification settings can be added here -->
                        </div>
                    </div>
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
