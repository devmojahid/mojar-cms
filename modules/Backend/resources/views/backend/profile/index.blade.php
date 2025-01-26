@extends('cms::layouts.backend')

@section('content')
<div class="profile-wrapper">
    <div class="row g-3">
        <!-- Profile Sidebar -->
        <div class="col-xl-3 col-lg-12">
            <!-- Profile Card -->
            <div class="card card-profile">
                <div class="card-body text-center">
                    <div class="profile-image mb-3">
                        <span class="avatar avatar-xl rounded-circle" style="background-image: url('{{ $jw_user->getAvatar() }}')"></span>
                        
                        <div class="profile-status">
                            <span class="badge bg-success">Active</span>
                        </div>
                    </div>
                    
                    <h3 class="mb-1">{{ $jw_user->name }}</h3>
                    <p class="text-muted mb-0">
                        {{ $jw_user->is_admin ? 'Administrator' : 'User' }}
                    </p>
                </div>
            </div>

            <!-- About Card -->
            <div class="card mt-3">
                <div class="card-status-top bg-primary"></div>
                <div class="card-header">
                    <h3 class="card-title">{{ trans('cms::profile.about_me') }}</h3>
                </div>

                <div class="card-body">
                    <div class="profile-info-item">
                        <div class="profile-info-icon">
                            <i class="ti ti-user"></i>
                        </div>
                        <div class="profile-info-content">
                            <span class="profile-info-label">{{ trans('cms::profile.full_name') }}</span>
                            <span class="profile-info-value">{{ $jw_user->name }}</span>
                        </div>
                    </div>

                    <div class="profile-info-item">
                        <div class="profile-info-icon">
                            <i class="ti ti-mail"></i>
                        </div>
                        <div class="profile-info-content">
                            <span class="profile-info-label">{{ trans('cms::profile.email') }}</span>
                            <span class="profile-info-value">{{ $jw_user->email }}</span>
                        </div>
                    </div>

                    <div class="profile-info-item">
                        <div class="profile-info-icon">
                            <i class="ti ti-cake"></i>
                        </div>
                        <div class="profile-info-content">
                            <span class="profile-info-label">{{ trans('cms::profile.birthday') }}</span>
                            <span class="profile-info-value">{{ $jw_user->getMeta('birthday') ?? '—' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Content -->
        <div class="col-xl-9 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                        <li class="nav-item">
                            <a href="#settings" class="nav-link @if (!isset($notification)) active @endif" data-bs-toggle="tab">
                                <i class="ti ti-settings me-2"></i>{{ trans('cms::app.settings') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#notifications" class="nav-link @if (isset($notification)) active @endif" data-bs-toggle="tab">
                                <i class="ti ti-bell me-2"></i>{{ trans('cms::app.notifications') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#change-password" class="nav-link" data-bs-toggle="tab">
                                <i class="ti ti-lock me-2"></i>{{ trans('cms::app.change_password') }}
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane @if (!isset($notification)) active show @endif" id="settings">
                            @include('cms::backend.profile.components.info')
                        </div>

                        <div class="tab-pane @if (isset($notification)) active show @endif" id="notifications">
                            @if (isset($notification))
                                <a href="{{ route('admin.profile') }}" class="btn btn-outline-primary mb-3">
                                    <i class="ti ti-arrow-left me-2"></i>{{ trans('cms::app.notifications') }}
                                </a>

                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">{{ $notification->subject }}</h3>
                                        <span class="notification-time">
                                            <i class="ti ti-clock me-1"></i>
                                            {{ $notification->created_at?->diffForHumans() }}
                                        </span>
                                    </div>

                                    <div class="card-body">
                                        {!! $notification->data['body'] !!}
                                    </div>
                                </div>
                            @else
                                {{ $dataTable->render() }}
                            @endif
                        </div>

                        <div class="tab-pane" id="change-password">
                            @include('cms::backend.profile.components.change_password')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
    <style>
        .card .card-header .time {
            right: 10px;
            position: absolute;
            top: 5px;
            font-size: 12px;
        }
    </style>
@endsection
