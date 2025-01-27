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
                    {{ trans('cms::app.add_new') }}
                </a>
            @endif
        </div>
    </div>
@endsection

@section('content')
    <div class="card plugin-index">
        <div class="card-header justify-content-between align-items-center">

            <div class="search-action">
                <form method="get" class="d-flex flex-wrap align-items-center gap-2" id="form-search">
                    <div class="form-group mb-2">
                        <label for="search" class="sr-only">{{ trans('cms::app.search') }}</label>
                        <input name="search" type="text" id="search" class="form-control"
                            placeholder="{{ trans('cms::app.search') }}" autocomplete="off">
                    </div>

                    <div class="form-group mb-2">
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
                                                    class="rounded">
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

    @include('cms::components.custom-alert')

    <script>
        // 3) The plugin logic (replacing confirm/sweetalert usage with CustomAlert)
        $(function() {
            // Handle all dropdown actions
            $('.dropdown-menu .dropdown-item').on('click', function(e) {
                e.preventDefault();

                const $link = $(this);
                const href = $link.attr('href');
                const dataAction = $link.data('action');

                // If there's no data-action (like a settings link), go directly
                if (typeof dataAction === 'undefined') {
                    if (href && href !== '#') {
                        window.location.href = href;
                    }
                    return;
                }

                // Gather plugin info from the link
                const $pluginCard = $link.closest('.col-lg-6');
                const $cardBody = $pluginCard.find('.card-body');
                const url = new URL(href, window.location.origin);
                const action = url.searchParams.get('action');
                const pluginId = url.searchParams.get('plugin');

                // Decide if it's a destructive action
                if (['delete', 'deactivate'].includes(action)) {
                    // Show custom alert
                    CustomAlert.show({
                        title: "{{ trans('cms::app.are_you_sure') }}",
                        message: "{{ trans('cms::app.action_cannot_be_undone') }}",
                        icon: "danger",
                        confirmText: "{{ trans('cms::app.ok') }}",
                        cancelText: "{{ trans('cms::app.cancel') }}",
                        confirmBtnClass: "btn-danger",
                        onConfirm: function() {
                            // Proceed if user confirms
                            proceedWithAjax(action, pluginId, $cardBody, $pluginCard);
                            // Optional: hide the modal manually if you don't have data-bs-dismiss
                            // CustomAlert.hide();
                        },
                        onCancel: function() {
                            // User canceled
                        }
                    });
                } else {
                    // Non-destructive: proceed directly
                    proceedWithAjax(action, pluginId, $cardBody, $pluginCard);
                }
            });

            // Reusable AJAX function
            function proceedWithAjax(action, pluginId, $cardBody, $pluginCard) {
                $cardBody.addClass('opacity-50');

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
                                    // Additional update logic here
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

            // Update UI for activate/deactivate
            function updatePluginStatus($card, newStatus) {
                const isActive = newStatus === 'active';

                $card.find('.card-status-top')
                    .removeClass('bg-green bg-red')
                    .addClass(isActive ? 'bg-green' : 'bg-red');

                $card.find('.badge')
                    .first()
                    .removeClass('bg-green bg-red')
                    .addClass(isActive ? 'bg-green' : 'bg-red')
                    .text(isActive ? 'Active' : 'Inactive');

                const $dropdown = $card.find('.dropdown-menu');
                const $actionLink = $dropdown.find('[data-action]').first();

                if (isActive) {
                    $actionLink
                        .attr('href', $actionLink.attr('href').replace('activate', 'deactivate'))
                        .attr('data-action', 'deactivate')
                        .text("{{ trans('cms::app.deactivate') }}");
                    // If you have a data-settings-link, show it if needed
                    if ($dropdown.data('has-settings')) {
                        $dropdown.find('[data-settings-link]').show();
                    }
                } else {
                    $actionLink
                        .attr('href', $actionLink.attr('href').replace('deactivate', 'activate'))
                        .attr('data-action', 'activate')
                        .text("{{ trans('cms::app.activate') }}");
                    $dropdown.find('[data-settings-link]').hide();
                }
            }

            // Show toast notification
            function showNotification(response) {
                if (typeof juzaweb !== 'undefined' && typeof juzaweb.message !== 'undefined') {
                    juzaweb.message(response);
                } else {
                    const toastHtml = `
              <div class="toast show" role="alert" aria-live="assertive"
                   aria-atomic="true" data-bs-autohide="true" data-bs-delay="3000">
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
    <script>
        $(document).ready(function() {
            $('#form-search').on('submit', function(e) {
                e.preventDefault();

                // Collect form data
                const formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('admin.plugin.get-data') }}", // or your route for fetching plugin data
                    method: "GET",
                    data: formData,
                    success: function(response) {
                        // Suppose the server returns HTML that updates the plugin cards.
                        // For example, if you return just the <div class="row row-cards m-2">...</div> content.
                        $('.row-cards.m-2').html(response.html || response);

                        // Optionally, update any pagination or other UI if needed.
                    },
                    error: function() {
                        // Handle error gracefully
                        alert("Error loading search results. Please try again.");
                    }
                });
            });
        });
    </script>
@endsection
