<div class="card">
    <div class="card-header justify-content-between align-items-center" style="border-bottom: none">
        @if ($actions)
            <div>
                <form method="post" class="form-inline">
                    @csrf
                    <div class="dropdown d-inline-block mb-2 mr-2">
                        {{-- <button type="button" class="btn btn-primary dropdown-toggle bulk-actions-button"
                        data-toggle="dropdown" aria-expanded="false">
                        {{ trans('cms::app.bulk_actions') }}
                    </button> --}}
                        {{-- <div class="dropdown-menu bulk-actions-actions" role="menu" x-placement="bottom-start">
                        @foreach ($actions as $key => $action)
                            <a class="dropdown-item select-action action-{{ $key }} @if ($key == 'delete') text-danger @endif"
                                href="javascript:void(0)"
                                data-action="{{ $key }}">{{ is_array($action) ? $action['label'] : $action }}
                            </a>
                        @endforeach
                    </div> --}}
                        <div class="dropdown">
                            <button href="#" class="btn dropdown-toggle" data-bs-toggle="dropdown">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-list">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M9 6l11 0" />
                                    <path d="M9 12l11 0" />
                                    <path d="M9 18l11 0" />
                                    <path d="M5 6l0 .01" />
                                    <path d="M5 12l0 .01" />
                                    <path d="M5 18l0 .01" />
                                </svg>
                                {{ trans('cms::app.bulk_actions') }}
                            </button>
                            <div class="dropdown-menu dropdown-menu-arrow">
                                <span class="dropdown-header">
                                    {{ trans('cms::app.bulk_actions') }}
                                </span>
                                @foreach ($actions as $key => $action)
                                    <a class="dropdown-item select-action action-{{ $key }} @if ($key == 'delete') text-danger @endif"
                                        href="javascript:void(0)"
                                        data-action="{{ $key }}">{{ is_array($action) ? $action['label'] : $action }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        @endif

        @php
            $hasDetailFormater = collect($columns)->whereNotNull('detailFormater')->isNotEmpty();
        @endphp

        @if ($searchable)
            <div>
                <form method="get" class="form-inline" id="form-search">
                    @foreach ($searchFields as $name => $field)
                        {{ $searchFieldTypes[$field['type']]['view']->with([
                            'name' => $name,
                            'field' => $field,
                        ]) }}
                    @endforeach

                    <button type="submit" class="btn btn-primary mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                            <path d="M21 21l-6 -6" />
                        </svg>
                        {{ trans('cms::app.search') }}
                    </button>
                </form>
            </div>
        @endif
    </div>

    <div class="card-table">
        <div class="table-responsive">
            <table class="table jw-table" id="{{ $uniqueId }}"
                @if ($hasDetailFormater) data-detail-view="true"
            data-detail-formatter="detailFormater" @endif>
                <thead>
                    <tr>
                        <th data-width="3%" data-checkbox="true"></th>
                        @foreach ($columns as $key => $column)
                            <th data-width="{{ $column['width'] ?? 'auto' }}"
                                data-align="{{ $column['align'] ?? 'left' }}" data-field="{{ $key }}"
                                data-sortable="{{ $column['sortable'] ?? true }}"
                                @if (in_array($key, $escapes)) data-escape="true" @endif>
                                {{ $column['label'] ?? strtoupper($key) }}
                            </th>
                        @endforeach
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@php
    if (!isset($dataUrl)) {
        $data = [
            'table' => $table,
            'data' => json_encode($params),
            'currentUrl' => url()->current(),
        ];

        $dataUrl = route('admin.datatable.get-data') . '?' . http_build_query($data);
    }

    if (!isset($actionUrl)) {
        $data = [
            'table' => $table,
            'data' => json_encode($params),
            'currentUrl' => url()->current(),
        ];

        $actionUrl = route('admin.datatable.bulk-actions') . '?' . http_build_query($data);
    }
@endphp

<script type="text/javascript">
    @if (!empty($hasDetailFormater))
        function detailFormater(index, row) {
            return row.detailFormater;
        }
    @endif

    const table = new MojarTable({
        table: "#{{ $uniqueId }}",
        page_size: parseInt("{{ $perPage }}"),
        sort_name: "{{ $sortName }}",
        sort_order: "{{ $sortOder }}",
        url: "{!! $dataUrl !!}",
        action_url: "{!! $actionUrl !!}"
    });
</script>
