@extends('cms::layouts.backend')

@section('content')
    <div class="row">
        <div class="container-xl">
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="card-title mb-0 d-flex align-items-center">
                        <span class="me-2">Common Settings</span>
                        <span class="badge bg-primary-subtle text-primary fs-6">System</span>
                    </h4>
                </div>
            
                <div class="card-body">
                    <div class="row g-3">
                        @php
                            $settings = [
                                [
                                    'id' => 'general',
                                    'title' => 'General',
                                    'description' => 'View and update your general settings and activate license',
                                    'icon' => [
                                        'type' => 'tabler', // Options: 'tabler', 'fontawesome', 'svg'
                                        'value' => 'settings',
                                        // For SVG, include the entire SVG markup in 'svg' key
                                        'svg' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" /><path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /></svg>'
                                    ],
                                    'url' => 'javascript:void(0)',
                                    'priority' => -9999
                                ],
                                [
                                    'id' => 'email',
                                    'title' => 'Email',
                                    'description' => 'View and update your email settings and email templates',
                                    'icon' => [
                                        'type' => 'fontawesome',
                                        'value' => 'fa-envelope'
                                    ],
                                    'url' => '#',
                                    'priority' => -9990
                                ],
                                // Add other settings items here...
                            ];
            
                            usort($settings, function($a, $b) {
                                return $a['priority'] <=> $b['priority'];
                            });
                        @endphp
            
                        @foreach($settings as $setting)
                            <div class="col-12 col-sm-6 col-md-4" id="panel-section-item-settings-{{ $setting['id'] }}">
                                <div class="card card-sm settings-card h-100">
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-auto">
                                                <div class="settings-icon-wrapper">
                                                    @switch($setting['icon']['type'])
                                                        @case('tabler')
                                                            <i class="ti ti-{{ $setting['icon']['value'] }}"></i>
                                                            @break
                                                        @case('fontawesome')
                                                            <i class="fas {{ $setting['icon']['value'] }}"></i>
                                                            @break
                                                        @case('svg')
                                                            {!! $setting['icon']['svg'] !!}
                                                            @break
                                                    @endswitch
                                                </div>
                                            </div>
                                            <div class="col">
                                                <h3 class="settings-title mb-1">
                                                    <a href="{{ $setting['url'] }}" class="text-decoration-none stretched-link">
                                                        {{ $setting['title'] }}
                                                    </a>
                                                </h3>
                                                <p class="text-muted mb-0 settings-description">
                                                    {{ $setting['description'] }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
