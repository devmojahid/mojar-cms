@extends('cms::layouts.backend')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-12">
                        <h5>{{ trans('dev-tool::content.marketplace') }}</h5>
                    </div>
                </div>
            </div>
            
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card p-3">
                            <div class="d-flex align-items-center">
                                <span class="stamp stamp-md bg-blue mr-3">
                                    <i class="fa fa-paint-brush"></i>
                                </span>
                                <div>
                                    <h5 class="mb-1"><a href="{{ route('admin.dev-tool.marketplace-themes.index') }}">{{ trans('dev-tool::content.themes') }}</a></h5>
                                    <small class="text-muted">{{ trans('dev-tool::content.manage_marketplace_themes') }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card p-3">
                            <div class="d-flex align-items-center">
                                <span class="stamp stamp-md bg-green mr-3">
                                    <i class="fa fa-plug"></i>
                                </span>
                                <div>
                                    <h5 class="mb-1"><a href="{{ route('admin.dev-tool.marketplace-plugins.index') }}">{{ trans('dev-tool::content.plugins') }}</a></h5>
                                    <small class="text-muted">{{ trans('dev-tool::content.manage_marketplace_plugins') }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 