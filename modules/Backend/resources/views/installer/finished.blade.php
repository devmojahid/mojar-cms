@extends('cms::installer.layouts.master')

@section('template_title')
    {{ trans('cms::installer.final.template_title') }}
@endsection

@section('title')
    <i class="fa fa-flag-checkered fa-fw" aria-hidden="true"></i>
    {{ trans('cms::installer.final.title') }}
@endsection

@section('container')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Installation Complete</h2>
    </div>
    <div class="card-content">
        <div class="text-center space-y-6 py-8">
            <div class="w-20 h-20 rounded-full bg-green-100 text-green-500 flex items-center justify-center mx-auto">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div class="space-y-2">
                <h2 class="text-2xl font-bold">Congratulations!</h2>
                <p class="text-muted">Your application has been successfully installed and configured.</p>
            </div>
            <div class="max-w-md mx-auto space-y-4 text-left">
                <h3 class="font-medium">Next Steps:</h3>
                <ul class="space-y-2 text-sm text-muted">
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Access your admin dashboard
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Configure your application settings
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Import your initial data
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Set up your email templates
                    </li>
                </ul>
            </div>
            <div class="pt-6 flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#" class="button button-outline">View Documentation</a>
                <a href="#" class="button">Go to Dashboard</a>
            </div>
        </div>
    </div>
</div>
    {{-- <div class="buttons">
        <a href="{{ url(config('mojar.admin_prefix')) }}" class="button"
            data-turbolinks="false">{{ trans('cms::installer.final.exit') }}</a>
    </div> --}}
@endsection
