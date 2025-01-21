@extends('cms::layouts.backend')

@section('breadcrumb-right')
    <div class="col-auto mb-3">
        <div class="btn-group float-right">
            @if (config('mojar.plugin.enable_upload'))
                <a href="{{ route('admin.plugin.install') }}" class="btn btn-tabler">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 5l0 14" />
                        <path d="M5 12l14 0" />
                    </svg>
                    {{ trans('cms::app.add_new') }}</a>
            @endif
        </div>
    </div>
@endsection

@section('content')
    <div class="card plugin-index">
        <div class="card-header justify-content-between align-items-center">
            <div class="bulk-action">
                <form method="post" class="form-inline">
                    @csrf
                    <div class="d-flex">
                        <select name="bulk_actions" id="bulk-actions" class="form-select">
                            <option value="">{{ trans('cms::app.bulk_actions') }}</option>
                            <option value="activate">{{ trans('cms::app.activate') }}</option>
                            <option value="deactivate">{{ trans('cms::app.deactivate') }}</option>
                            @if (config('mojar.plugin.enable_upload'))
                                <option value="delete">{{ trans('cms::app.delete') }}</option>
                            @endif
                        </select>

                        <button type="submit" class="btn btn-tabler"
                            id="apply-action">{{ trans('cms::app.apply') }}</button>
                    </div>
                </form>
            </div>
            <div class="search-action">
                <form method="get" class="form-inline" id="form-search">
                    <div class="form-group mb-2 mr-1">
                        <label for="search" class="sr-only">{{ trans('cms::app.search') }}</label>
                        <input name="search" type="text" id="search" class="form-control"
                            placeholder="{{ trans('cms::app.search') }}" autocomplete="off">
                    </div>

                    <div class="form-group mb-2 mr-1">
                        <label for="status" class="sr-only">{{ trans('cms::app.status') }}</label>
                        <select name="status" id="status" class="form-control select2-default">
                            <option value="">{{ trans('cms::app.all_status') }}</option>
                            <option value="1">{{ trans('cms::app.enabled') }}</option>
                            <option value="0">{{ trans('cms::app.disabled') }}</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary mb-2">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                <path d="M21 21l-6 -6" />
                            </svg>
                        </span>
                        {{ trans('cms::app.search') }}
                    </button>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="form-selectgroup">
                <div class="row row-cards m-2">
                    @php
                        $pluginData = $data->getData();
                    @endphp
                    @foreach ($pluginData->rows as $plugin)
                    <div class="col-lg-6">
                        <label class="form-selectgroup-item">
                            <input type="checkbox" name="name" value="CSS" class="form-selectgroup-input">
                            <div class="card">
                                <div class="card-status-top bg-{{ $plugin->status == 'active' ? 'green' : 'red' }}"></div>
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <img src="{{ $plugin->screenshot }}" alt="{{ $plugin->name }}" class="rounded">
                                        </div>
                                        <div class="col">
                                            <h3 class="card-title mb-1">
                                                <h3 class="text-reset">
                                                    {{ $plugin->name }}
                                                    <span class="badge {{ $plugin->status == 'active' ? 'bg-green' : 'bg-red' }} ms-2">
                                                        {{ $plugin->status == 'active' ? 'Active' : 'Inactive' }}
                                                    </span>
                                                    <span class="badge bg-blue ms-1">v{{ $plugin->version }}</span>
                                                </h3>
                                            </h3>
                                            <div class="text-secondary">
                                                {{ $plugin->description }}
                                            </div>
                                            <div class="mt-3">
                                                <div class="row g-2 align-items-center">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="dropdown">
                                                <a href="#" class="btn-action" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                                        <path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                                        <path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                                    </svg>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">

                                                    {{-- <script type="text/javascript">
                                                        function nameFormatter(value, row, index) {
                                                            let str = `<div class="font-weight-bold">${value}</div>`;

                                                            str += `<ul class="list-inline mb-0 list-actions mt-2 ">`;

                                                            if (row.status == 'active') {
                                                                str +=
                                                                    `<li class="list-inline-item"><a href="javascript:void(0)" class="jw-table-row action-item" data-id="${row.id}" data-action="deactivate">${mojar.lang.deactivate}</a></li>`;
                                                            } else {
                                                                str +=
                                                                    `<li class="list-inline-item"><a href="javascript:void(0)" class="jw-table-row action-item" data-id="${row.id}" data-action="activate">${mojar.lang.activate}</a></li>`;
                                                            }

                                                            if (row.setting && row.status == 'active') {
                                                                str +=
                                                                    `<li class="list-inline-item"><a href="${mojar.adminUrl +'/'+row.setting}" class="jw-table-row">${mojar.lang.setting}</a></li>`;
                                                            }

                                                            @if (config('mojar.plugin.enable_upload'))
                                                                if (row.update) {
                                                                    str +=
                                                                        `<li class="list-inline-item"><a href="javascript:void(0)" class="jw-table-row action-item" data-id="${row.id}" data-action="update">${mojar.lang.update}</a></li>`;
                                                                }

                                                                str +=
                                                                    `<li class="list-inline-item"><a href="javascript:void(0)" class="jw-table-row text-danger action-item" data-id="${row.id}" data-action="delete">${mojar.lang.delete}</a></li>`;
                                                            @endif
                                                            str += `</ul>`;
                                                            return str;
                                                        }

                                                        function statusFormatter(value, row, index) {
                                                            switch (value) {
                                                                case 'inactive':
                                                                    return `<span class='text-disable'>${mojar.lang.inactive}</span>`;
                                                            }

                                                            return `<span class='text-success'>${mojar.lang.active}</span>`;
                                                        }

                                                        var table = new MojarTable({
                                                            url: '{{ route('admin.plugin.get-data') }}',
                                                            action_url: '{{ route('admin.plugin.bulk-actions') }}',
                                                            chunk_action: true
                                                        });
                                                    </script> --}}

                                                    @if($plugin->status == 'active')
                                                    {{-- //deactive  --}}
                                                        <a href="{{ route('admin.plugin.bulk-actions', ['action' => 'deactivate', 'plugin' => $plugin->id]) }}" class="dropdown-item">{{ trans('cms::app.deactivate') }}</a>
                                                    @else
                                                        {{-- //active --}}
                                                        <a href="{{ route('admin.plugin.bulk-actions', ['action' => 'activate', 'plugin' => $plugin->id]) }}" class="dropdown-item">{{ trans('cms::app.activate') }}</a>
                                                    @endif

                                                    @if($plugin->setting && $plugin->status == 'active')
                                                        <a href="#"
                                                        {{-- href="{{mojar.adminUrl +'/'+row.setting}}" --}}
                                                         class="dropdown-item">{{ trans('cms::app.setting') }}</a>
                                                    @endif

                                                    @if (config('mojar.plugin.enable_upload'))
                                                        @if($plugin->update)
                                                            <a href="#" class="dropdown-item">{{ trans('cms::app.update') }}</a>
                                                        @endif
                                                        <a href="#" class="dropdown-item text-danger">{{ trans('cms::app.delete') }}</a>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


    {{-- <div class="row mb-2">
        <div class="col-md-3">
            <form method="post" class="form-inline">
                @csrf
                <select name="bulk_actions" id="bulk-actions" class="form-control w-60 mb-2 mr-1">
                    <option value="">{{ trans('cms::app.bulk_actions') }}</option>
                    <option value="activate">{{ trans('cms::app.activate') }}</option>
                    <option value="deactivate">{{ trans('cms::app.deactivate') }}</option>
                    @if (config('mojar.plugin.enable_upload'))
                        <option value="delete">{{ trans('cms::app.delete') }}</option>
                    @endif
                </select>

                <button type="submit" class="btn btn-primary px-2 mb-2"
                    id="apply-action">{{ trans('cms::app.apply') }}</button>
            </form>
        </div>

        <div class="col-md-9">
            <form method="get" class="form-inline" id="form-search">
                <div class="form-group mb-2 mr-1">
                    <label for="search" class="sr-only">{{ trans('cms::app.search') }}</label>
                    <input name="search" type="text" id="search" class="form-control"
                        placeholder="{{ trans('cms::app.search') }}" autocomplete="off">
                </div>

                <div class="form-group mb-2 mr-1">
                    <label for="status" class="sr-only">{{ trans('cms::app.status') }}</label>
                    <select name="status" id="status" class="form-control select2-default">
                        <option value="">{{ trans('cms::app.all_status') }}</option>
                        <option value="1">{{ trans('cms::app.enabled') }}</option>
                        <option value="0">{{ trans('cms::app.disabled') }}</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary mb-2">{{ trans('cms::app.search') }}</button>
            </form>
        </div>
    </div> --}}

    {{-- <div class="table-responsive mb-5">
        <table class="table jw-table mojar-table">
            <thead>
                <tr>
                    <th data-width="3%" data-field="state" data-checkbox="true"></th>
                    <th data-field="name" data-width="25%" data-formatter="nameFormatter">{{ trans('cms::app.name') }}
                    </th>
                    <th data-field="description">{{ trans('cms::app.description') }}</th>
                    <th data-field="version" data-width="10%">{{ trans('cms::app.version') }}</th>
                    <th data-width="15%" data-field="status" data-formatter="statusFormatter" data-align="center">
                        {{ trans('cms::app.status') }}</th>
                </tr>
            </thead>
        </table>
    </div> --}}

    {{-- <script type="text/javascript">
        function nameFormatter(value, row, index) {
            let str = `<div class="font-weight-bold">${value}</div>`;

            str += `<ul class="list-inline mb-0 list-actions mt-2 ">`;

            if (row.status == 'active') {
                str +=
                    `<li class="list-inline-item"><a href="javascript:void(0)" class="jw-table-row action-item" data-id="${row.id}" data-action="deactivate">${mojar.lang.deactivate}</a></li>`;
            } else {
                str +=
                    `<li class="list-inline-item"><a href="javascript:void(0)" class="jw-table-row action-item" data-id="${row.id}" data-action="activate">${mojar.lang.activate}</a></li>`;
            }

            if (row.setting && row.status == 'active') {
                str +=
                    `<li class="list-inline-item"><a href="${mojar.adminUrl +'/'+row.setting}" class="jw-table-row">${mojar.lang.setting}</a></li>`;
            }

            @if (config('mojar.plugin.enable_upload'))
                if (row.update) {
                    str +=
                        `<li class="list-inline-item"><a href="javascript:void(0)" class="jw-table-row action-item" data-id="${row.id}" data-action="update">${mojar.lang.update}</a></li>`;
                }

                str +=
                    `<li class="list-inline-item"><a href="javascript:void(0)" class="jw-table-row text-danger action-item" data-id="${row.id}" data-action="delete">${mojar.lang.delete}</a></li>`;
            @endif
            str += `</ul>`;
            return str;
        }

        function statusFormatter(value, row, index) {
            switch (value) {
                case 'inactive':
                    return `<span class='text-disable'>${mojar.lang.inactive}</span>`;
            }

            return `<span class='text-success'>${mojar.lang.active}</span>`;
        }

        var table = new MojarTable({
            url: '{{ route('admin.plugin.get-data') }}',
            action_url: '{{ route('admin.plugin.bulk-actions') }}',
            chunk_action: true
        });
    </script> --}}
@endsection
