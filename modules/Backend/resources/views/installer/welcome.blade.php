@extends('cms::installer.layouts.master')

@section('container')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Welcome to Setup Wizard</h2>
        </div>
        <div class="card-content">
            <div class="space-y-8">
                <div class="prose">
                    <p>Welcome to the installation wizard. This will guide you through the process of setting up your
                        application. Please follow these steps carefully to ensure proper configuration.</p>
                    <h3>Before you begin:</h3>
                    <ul>
                        <li>Ensure you have your database credentials ready</li>
                        <li>Check server requirements and permissions</li>
                        <li>Prepare your license key if required</li>
                        <li>Backup any existing data</li>
                    </ul>
                </div>
                <div class="space-y-4">
                    <div class="space-y-2">
                        <label for="language" class="text-sm font-medium">Select Installation Language</label>
                        <select id="language" class="select">
                            <option value="en">English</option>
                            <option value="es">Español</option>
                            <option value="fr">Français</option>
                            <option value="de">Deutsch</option>
                            <option value="it">Italiano</option>
                            <option value="pt">Português</option>
                        </select>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-4 items-center text-sm text-muted">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 rounded-full bg-green-500"></div>
                            <span>PHP Version: 8.1.0</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 rounded-full bg-green-500"></div>
                            <span>MySQL Version: 5.7+</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 rounded-full bg-green-500"></div>
                            <span>Server: Apache/Nginx</span>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                    <button class="button button-outline w-full sm:w-auto" disabled>Previous</button>
                    <a href="requirements.html" class="button w-full sm:w-auto">Start Installation</a>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- @extends('cms::installer.layouts.master')

@section('template_title')
    {{ trans('cms::installer.welcome.template_title') }}
@endsection

@section('title')
    {{ trans('cms::installer.welcome.title') }}
@endsection

@section('container')
    <p class="text-center">
      {{ trans('cms::installer.welcome.message') }}
    </p>

    <p class="text-center">
      <a href="{{ route('installer.requirements') }}" class="button">
        {{ trans('cms::installer.welcome.next') }}
        <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
      </a>
    </p>
@endsection --}}
