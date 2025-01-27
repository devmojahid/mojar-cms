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
                        <div class="flex items-center justify-between p-3 rounded-lg bg-gray-50">
                            <span class="text-sm font-medium">PHP Version (>= 8.1.0)</span>
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div class="flex items-center justify-between p-3 rounded-lg bg-gray-50">
                            <span class="text-sm font-medium">MySQL Version (>= 5.7)</span>
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div class="flex items-center justify-between p-3 rounded-lg bg-gray-50">
                            <span class="text-sm font-medium">BCMath PHP Extension</span>
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div class="flex items-center justify-between p-3 rounded-lg bg-gray-50">
                            <span class="text-sm font-medium">Ctype PHP Extension</span>
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div class="flex items-center justify-between p-3 rounded-lg bg-gray-50">
                            <span class="text-sm font-medium">JSON PHP Extension</span>
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div class="flex items-center justify-between p-3 rounded-lg bg-gray-50">
                            <span class="text-sm font-medium">Mbstring PHP Extension</span>
                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </div>
                        <div class="flex items-center justify-between p-3 rounded-lg bg-gray-50">
                            <span class="text-sm font-medium">OpenSSL PHP Extension</span>
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div class="flex items-center justify-between p-3 rounded-lg bg-gray-50">
                            <span class="text-sm font-medium">PDO PHP Extension</span>
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div class="flex items-center justify-between p-3 rounded-lg bg-gray-50">
                            <span class="text-sm font-medium">Tokenizer PHP Extension</span>
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div class="flex items-center justify-between p-3 rounded-lg bg-gray-50">
                            <span class="text-sm font-medium">XML PHP Extension</span>
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </div>
                </div>
                <div class="space-y-4">
                    <h3 class="text-lg font-medium">Directory Permissions</h3>
                    <div class="grid gap-2 requirements-list-wrapper-2">
                        <div class="flex items-center justify-between p-3 rounded-lg bg-gray-50">
                            <span class="text-sm font-medium">/storage/app</span>
                            <div class="flex items-center gap-2 text-green-500">
                                <span class="text-sm">Writable</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                        </div>
                        <div class="flex items-center justify-between p-3 rounded-lg bg-gray-50">
                            <span class="text-sm font-medium">/storage/framework</span>
                            <div class="flex items-center gap-2 text-green-500">
                                <span class="text-sm">Writable</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                        </div>
                        <div class="flex items-center justify-between p-3 rounded-lg bg-gray-50">
                            <span class="text-sm font-medium">/storage/logs</span>
                            <div class="flex items-center gap-2 text-red-500">
                                <span class="text-sm">Not Writable</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </div>
                        </div>
                        <div class="flex items-center justify-between p-3 rounded-lg bg-gray-50">
                            <span class="text-sm font-medium">/bootstrap/cache</span>
                            <div class="flex items-center gap-2 text-green-500">
                                <span class="text-sm">Writable</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                        </div>
                        <div class="flex items-center justify-between p-3 rounded-lg bg-gray-50">
                            <span class="text-sm font-medium">/.env</span>
                            <div class="flex items-center gap-2 text-green-500">
                                <span class="text-sm">Writable</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                <a href="index.html" class="button button-outline w-full sm:w-auto">Previous</a>
                <a href="environment.html" class="button w-full sm:w-auto">Continue</a>
            </div>
        </div>
    </div>
</div>

    {{-- @foreach($requirements['requirements'] as $type => $requirement)
        <ul class="list">
            <li class="list__item list__title {{ $phpSupportInfo['supported'] ? 'success' : 'error' }}">
                <strong>{{ ucfirst($type) }}</strong>
                @if($type == 'php')
                    <strong>
                        <small>
                            (version {{ $phpSupportInfo['minimum'] }} required)
                        </small>
                    </strong>
                    <span class="float-right">
                        <strong>
                            {{ $phpSupportInfo['current'] }}
                        </strong>
                        <i class="fa fa-fw fa-{{ $phpSupportInfo['supported'] ? 'check-circle-o' : 'exclamation-circle' }} row-icon" aria-hidden="true"></i>
                    </span>
                @endif
            </li>
            @foreach($requirements['requirements'][$type] as $extention => $enabled)
                <li class="list__item {{ $enabled ? 'success' : 'error' }}">
                    {{ $extention }}
                    <i class="fa fa-fw fa-{{ $enabled ? 'check-circle-o' : 'exclamation-circle' }} row-icon" aria-hidden="true"></i>
                </li>
            @endforeach
        </ul>
    @endforeach

    @if ( ! isset($requirements['errors']) && $phpSupportInfo['supported'] )
        <div class="buttons">
            <a class="button" href="{{ route('installer.permissions') }}">
                {{ trans('cms::installer.requirements.next') }}
                <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
            </a>
        </div>
    @endif --}}

@endsection
