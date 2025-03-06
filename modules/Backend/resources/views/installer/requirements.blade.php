@extends('cms::installer.layouts.master')

@section('template_title')
    {{ trans('cms::installer.requirements.template_title') }}
@endsection

@section('title')
    <i class="fa fa-list-ul fa-fw" aria-hidden="true"></i>
    {{ trans('cms::installer.requirements.title') }}
@endsection

@section('container')

<div class="card">
    <div class="card-header">
        <h2 class="card-title">System Requirements</h2>
    </div>
    <div class="card-content">
        <div class="space-y-8">
            <div class="space-y-6">

                <div class="space-y-4">
                    <h3 class="text-lg font-medium">PHP Extensions & Requirements</h3>
                    <div class="grid gap-2 requirements-list-wrapper">
                        @foreach($requirements['requirements'] as $type => $requirement)
                            @if($type == 'php')
                                <div class="flex items-center justify-between p-3 rounded-lg bg-gray-50">
                                    <span class="text-sm font-medium">PHP Version (>= {{ $phpSupportInfo['minimum'] }})</span>
                                    <svg class="w-5 h-5 text-{{ $phpSupportInfo['supported'] ? 'green' : 'red' }}-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        @if($phpSupportInfo['supported'])
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        @else
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        @endif
                                    </svg>
                                </div>
                            @endif
                            
                            @if($type == 'mysql')
                                <div class="flex items-center justify-between p-3 rounded-lg bg-gray-50">
                                    <span class="text-sm font-medium">MySQL Version (>= 5.7)</span>
                                    <svg class="w-5 h-5 text-{{ isset($mysqlSupportInfo) && $mysqlSupportInfo['supported'] ? 'green' : 'red' }}-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        @if(isset($mysqlSupportInfo) && $mysqlSupportInfo['supported'])
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        @else
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        @endif
                                    </svg>
                                </div>
                            @endif
                            
                            @foreach($requirement as $extension => $enabled)
                                <div class="flex items-center justify-between p-3 rounded-lg bg-gray-50">
                                    <span class="text-sm font-medium">{{ $extension }} {{ $type == 'php' ? 'PHP Extension' : '' }}</span>
                                    <svg class="w-5 h-5 text-{{ $enabled ? 'green' : 'red' }}-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        @if($enabled)
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        @else
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        @endif
                                    </svg>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>

                <div class="space-y-4">
                    <h3 class="text-lg font-medium">Directory Permissions</h3>
                    <div class="grid gap-2 requirements-list-wrapper-2">
                        @foreach($permissions['permissions'] as $permission)
                            <div class="flex items-center justify-between p-3 rounded-lg bg-gray-50">
                                <span class="text-sm font-medium">{{ $permission['folder'] }}</span>
                                <div class="flex items-center gap-2 text-{{ $permission['isSet'] ? 'green' : 'red' }}-500">
                                    <span class="text-sm">{{ $permission['isSet'] ? 'Writable' : 'Not Writable' }}</span>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        @if($permission['isSet'])
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        @else
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        @endif
                                    </svg>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                <a href="{{ route('installer.welcome') }}" class="button button-outline w-full sm:w-auto">Previous</a>
                @if ( ! isset($requirements['errors']) && $phpSupportInfo['supported'] && ! isset($permissions['errors']) )
                    <a href="{{ route('installer.environment') }}" class="button w-full sm:w-auto">Continue</a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection