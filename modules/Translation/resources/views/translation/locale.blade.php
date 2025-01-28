@extends('cms::layouts.backend')

@section('content')
    <div class="card">
        <div class="card-header justify-content-between align-items-center">
            <h3 class="card-title">{{ trans('cms::app.translations') }}</h3>
                <div class="header-action">
                    <form method="get" class="form-inline" id="form-search">
                        <div class="form-group mb-2 mr-1">
                            <label for="search" class="sr-only">@lang('cms::app.search')</label>
                            <input name="search" type="text" id="search" class="form-control"
                                placeholder="{{ trans('cms::app.search') }}" autocomplete="off">
                        </div>

                        <button type="submit" class="btn btn-tabler mb-2">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                    <path d="M21 21l-6 -6" />
                                </svg>
                            </span>
                            @lang('cms::app.search')
                        </button>
                    </form>
                </div>
        </div>
        <div class="card-body">

            <div class="table-responsive mb-5">
                <table class="table mojar-table">
                    <thead>
                        <tr>
                            <th data-field="index" data-width="3%" data-formatter="index_formatter" data-align="center">#
                            </th>
                            <th data-field="value" data-width="35%" data-formatter="origin_formatter">
                                {{ trans('cms::app.origin') }}</th>
                            <th data-formatter="translate_formatter">{{ trans('cms::app.your_value') }}</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function index_formatter(value, row, index) {
            return (index + 1);
        }

        function origin_formatter(value, row, index) {
            return `<span title="${row.key}">${row.value}</span>`;
        }

        function translate_formatter(value, row, index) {
            return `<input class="form-control trans-input" value="${row.trans}" data-key="${row.key}" data-group="${row.group}">`;
        }

        let table = new MojarTable({
            url: '{{ route('admin.translations.locale.get-data', [$type, $locale]) }}',
        });

        $(document).on('change', '.trans-input', function() {
            let key = $(this).data('key');
            let group = $(this).data('group');
            let value = $(this).val();

            $.ajax({
                type: 'POST',
                url: '{{ route('admin.translations.locale.save', [$type, $locale]) }}',
                dataType: 'json',
                data: {
                    'key': key,
                    'value': value,
                    'group': group,
                }
            }).done(function(response) {
                if (response.status === false) {
                    show_message(response);
                    return false;
                }

                return false;
            }).fail(function(response) {
                show_message(response);
                return false;
            });
        });
    </script>
@endsection
