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
                                    <div class="card-status-top bg-{{ $plugin->status == 'active' ? 'green' : 'red' }}">
                                    </div>
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-3">
                                                <img src="{{ $plugin->screenshot }}" alt="{{ $plugin->name }}"
                                                    class="rounded" style="height: 122px; object-fit: contain;">
                                            </div>
                                            <div class="col">
                                                <h3 class="card-title mb-1">
                                                    <h3 class="text-reset">
                                                        {{ $plugin->name }}
                                                        <span
                                                            class="badge {{ $plugin->status == 'active' ? 'bg-green' : 'bg-red' }} ms-2">
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
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                                            width="24" height="24" viewBox="0 0 24 24"
                                                            stroke-width="2" stroke="currentColor" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round">
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

                                                        @if ($plugin->status == 'active')
                                                            <a href="{{ route('admin.plugin.bulk-actions', ['action' => 'deactivate', 'plugin' => $plugin->id]) }}"
                                                                class="dropdown-item" data-action="deactivate">
                                                                {{ trans('cms::app.deactivate') }}
                                                            </a>
                                                        @else
                                                            <a href="{{ route('admin.plugin.bulk-actions', ['action' => 'activate', 'plugin' => $plugin->id]) }}"
                                                                class="dropdown-item" data-action="activate">
                                                                {{ trans('cms::app.activate') }}
                                                            </a>
                                                        @endif

                                                        @if ($plugin->setting && $plugin->status == 'active')
                                                            <a href="{{ $plugin->setting }}" class="dropdown-item"
                                                                data-settings-link>
                                                                {{ trans('cms::app.setting') }}
                                                            </a>
                                                        @endif

                                                        @if (config('mojar.plugin.enable_upload'))
                                                            @if ($plugin->update)
                                                                <a href="{{ route('admin.plugin.bulk-actions', ['action' => 'update', 'plugin' => $plugin->id]) }}"
                                                                    class="dropdown-item" data-action="update">
                                                                    {{ trans('cms::app.update') }}
                                                                </a>
                                                            @endif
                                                            <a href="{{ route('admin.plugin.bulk-actions', ['action' => 'delete', 'plugin' => $plugin->id]) }}"
                                                                class="dropdown-item text-danger" data-action="delete">
                                                                {{ trans('cms::app.delete') }}
                                                            </a>
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

    

    <script>
        $(function() {
            // Handle all dropdown actions
            $('.dropdown-menu .dropdown-item').on('click', function(e) {
                e.preventDefault();

                const $link = $(this);
                const href = $link.attr('href');

                // Skip if it's a settings link or something with no data-action
                if ($link.data('action') === undefined) {
                    if (href && href !== '#') {
                        window.location.href = href;
                    }
                    return;
                }

                // Get the plugin card container
                const $pluginCard = $link.closest('.col-lg-6');
                const $cardBody = $pluginCard.find('.card-body');

                // Extract action and plugin ID from the URL
                const url = new URL(href, window.location.origin);
                const action = url.searchParams.get('action');
                const pluginId = url.searchParams.get('plugin');

                // If it's a destructive action, show SweetAlert confirmation
                if (['delete', 'deactivate'].includes(action)) {
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!"
                        }).then((result) => {
                        if (result.isConfirmed) {
                            console.log('confirmed');
                            Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success"
                            });
                        }else{
                            console.log('canceled');
                            return;
                        }
                    });
                    // Swal.fire({
                    //     title: "{{ trans('cms::app.are_you_sure') }}",
                    //     text: "{{ trans('cms::app.action_cannot_be_undone') }}", // or any text you prefer
                    //     icon: "warning",
                    //     showCancelButton: true,
                    //     confirmButtonColor: "#d33",
                    //     cancelButtonColor: "#6c757d",
                    //     confirmButtonText: "{{ trans('cms::app.ok') }}",
                    //     cancelButtonText: "{{ trans('cms::app.cancel') }}"
                    // }).then((result) => {
                    //     // Only proceed if the user confirmed
                    //     if (result.isConfirmed) {
                    //         console.log('confirmed');
                    //         proceedWithAjax(action, pluginId, $cardBody, $pluginCard);
                    //     } else {
                    //         console.log('canceled');
                    //         return;
                    //     }
                    // });
                } else {
                    // Non-destructive actions proceed directly
                    proceedWithAjax(action, pluginId, $cardBody, $pluginCard);
                }
            });

            /**
             * Function to proceed with the AJAX call. 
             * This way we don't repeat code in the Swal callback.
             */
            function proceedWithAjax(action, pluginId, $cardBody, $pluginCard) {
                console.log(action, pluginId, $cardBody, $pluginCard);
                // Add loading state
                $cardBody.addClass('opacity-50');

                // Send AJAX request
                $.ajax({
                    url: "{{ route('admin.plugin.bulk-actions') }}",
                    type: 'POST',
                    data: {
                        action: action,
                        ids: [pluginId],
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.status) {
                            // Handle different actions
                            switch (action) {
                                case 'activate':
                                    updatePluginStatus($pluginCard, 'active');
                                    break;
                                case 'deactivate':
                                    updatePluginStatus($pluginCard, 'inactive');
                                    break;
                                case 'delete':
                                    $pluginCard.fadeOut(300, function() {
                                        $(this).remove();
                                    });
                                    break;
                                case 'update':
                                    // Handle update success if needed
                                    break;
                            }
                        }

                        showNotification({
                            status: response.status,
                            message: response.message || "{{ trans('cms::app.success') }}"
                        });
                    },
                    error: function(xhr) {
                        showNotification({
                            status: false,
                            message: xhr.responseJSON?.message ||
                                "{{ trans('cms::app.error_occurred') }}"
                        });
                    },
                    complete: function() {
                        $cardBody.removeClass('opacity-50');
                    }
                });
            }

            // Function to update plugin status UI
            function updatePluginStatus($card, newStatus) {
                const isActive = newStatus === 'active';

                // Update status indicator
                $card.find('.card-status-top')
                    .removeClass('bg-green bg-red')
                    .addClass(isActive ? 'bg-green' : 'bg-red');

                // Update status badge
                $card.find('.badge')
                    .first()
                    .removeClass('bg-green bg-red')
                    .addClass(isActive ? 'bg-green' : 'bg-red')
                    .text(isActive ? 'Active' : 'Inactive');

                // Update dropdown actions
                const $dropdown = $card.find('.dropdown-menu');
                const $actionLink = $dropdown.find('[data-action]').first();

                if (isActive) {
                    $actionLink
                        .attr('href', $actionLink.attr('href').replace('activate', 'deactivate'))
                        .attr('data-action', 'deactivate')
                        .text("{{ trans('cms::app.deactivate') }}");

                    // Show settings link if available
                    if ($dropdown.data('has-settings')) {
                        $dropdown.find('[data-settings-link]').show();
                    }
                } else {
                    $actionLink
                        .attr('href', $actionLink.attr('href').replace('deactivate', 'activate'))
                        .attr('data-action', 'activate')
                        .text("{{ trans('cms::app.activate') }}");

                    // Hide settings link
                    $dropdown.find('[data-settings-link]').hide();
                }
            }

            // Helper function to show notifications (toast)
            function showNotification(response) {
                if (typeof juzaweb !== 'undefined' && typeof juzaweb.message !== 'undefined') {
                    juzaweb.message(response);
                } else {
                    const toastHtml = `
                    <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="3000">
                        <div class="toast-header">
                            <span class="avatar avatar-xs me-2 ${response.status ? 'bg-success' : 'bg-danger'}">
                                <i class="fas fa-${response.status ? 'check' : 'times'} text-white"></i>
                            </span>
                            <strong class="me-auto">${response.status ? 'Success' : 'Error'}</strong>
                            <small>just now</small>
                            <button type="button" class="ms-2 btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            ${response.message}
                        </div>
                    </div>
                `;

                    let toastContainer = document.querySelector('.toast-container');
                    if (!toastContainer) {
                        toastContainer = document.createElement('div');
                        toastContainer.className = 'toast-container position-fixed top-0 end-0 p-3';
                        document.body.appendChild(toastContainer);
                    }

                    const toastElement = $(toastHtml).appendTo(toastContainer)[0];
                    const toast = new bootstrap.Toast(toastElement);
                    toast.show();

                    $(toastElement).on('hidden.bs.toast', function() {
                        $(this).remove();
                    });
                }
            }
        });
    </script>

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
