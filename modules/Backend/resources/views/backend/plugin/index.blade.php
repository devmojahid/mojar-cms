@extends('cms::layouts.backend')

@section('content')
    <div class="row mb-2">
        <div class="col-md-6"></div>
        <div class="col-md-6">
            <div class="btn-group float-right">
                @if (config('mojar.plugin.enable_upload'))
                    <a href="{{ route('admin.plugin.install') }}" class="btn btn-success" data-turbolinks="false"><i
                            class="fa fa-plus-circle"></i> {{ trans('cms::app.add_new') }}</a>
                @endif
            </div>
        </div>
    </div>

    <div class="row row-cards">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-status-top bg-red"></div>
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-3">
                  <img src="https://cdn.dribbble.com/users/844826/screenshots/14553706/media/2be9a4847b939e02702648d058cf2df8.png" alt="Food Deliver UI dashboards" class="rounded">
                </div>
                <div class="col">
                  <h3 class="card-title mb-1">
                    <a href="#" class="text-reset">Food Deliver UI dashboards</a>
                  </h3>
                  <div class="text-secondary">
                    Updated 2 hours ago
                  </div>
                  <div class="mt-3">
                    <div class="row g-2 align-items-center">
                      <div class="col-auto">
                        25%
                      </div>
                      <div class="col">
                        <div class="progress progress-sm">
                          <div class="progress-bar" style="width: 25%" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" aria-label="25% Complete">
                            <span class="visually-hidden">25% Complete</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-auto">
                  <div class="dropdown">
                    <a href="#" class="btn-action" data-bs-toggle="dropdown" aria-expanded="false">
                      <!-- Download SVG icon from http://tabler-icons.io/i/dots-vertical -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /></svg>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                      <a href="#" class="dropdown-item">Import</a>
                      <a href="#" class="dropdown-item">Export</a>
                      <a href="#" class="dropdown-item">Download</a>
                      <a href="#" class="dropdown-item text-danger">Delete</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-3">
                  <img src="https://cdn.dribbble.com/users/844826/screenshots/14547977/media/e7749bd1b09d9415b8dc265a7dbe81f6.png" alt="Projects Dashboards" class="rounded">
                </div>
                <div class="col">
                  <h3 class="card-title mb-1">
                    <a href="#" class="text-reset">Projects Dashboards</a>
                  </h3>
                  <div class="text-secondary">
                    Updated 2 hours ago
                  </div>
                  <div class="mt-3">
                    <div class="row g-2 align-items-center">
                      <div class="col-auto">
                        76%
                      </div>
                      <div class="col">
                        <div class="progress progress-sm">
                          <div class="progress-bar" style="width: 76%" role="progressbar" aria-valuenow="76" aria-valuemin="0" aria-valuemax="100" aria-label="76% Complete">
                            <span class="visually-hidden">76% Complete</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-auto">
                  <div class="dropdown">
                    <a href="#" class="btn-action" data-bs-toggle="dropdown" aria-expanded="false">
                      <!-- Download SVG icon from http://tabler-icons.io/i/dots-vertical -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /></svg>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                      <a href="#" class="dropdown-item">Import</a>
                      <a href="#" class="dropdown-item">Export</a>
                      <a href="#" class="dropdown-item">Download</a>
                      <a href="#" class="dropdown-item text-danger">Delete</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>

    <div class="row mb-2">
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
    </div>

    <div class="table-responsive mb-5">
        <table class="table jw-table mojar-table">
            <thead>
                <tr>
                    <th data-width="3%" data-field="state" data-checkbox="true"></th>
                    <th data-field="name" data-width="25%" data-formatter="nameFormatter">{{ trans('cms::app.name') }}</th>
                    <th data-field="description">{{ trans('cms::app.description') }}</th>
                    <th data-field="version" data-width="10%">{{ trans('cms::app.version') }}</th>
                    <th data-width="15%" data-field="status" data-formatter="statusFormatter" data-align="center">
                        {{ trans('cms::app.status') }}</th>
                </tr>
            </thead>
        </table>
    </div>

    <script type="text/javascript">
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
    </script>
@endsection
