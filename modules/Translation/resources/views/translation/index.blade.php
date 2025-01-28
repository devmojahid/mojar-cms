@extends('cms::layouts.backend')
@section('content')
<div class="card">
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="table-responsive mb-5">
                <table class="table mojar-table table-hover">
                    <thead>
                        <tr>
                            <th data-field="index" data-width="3%" data-formatter="index_formatter" data-align="center">#</th>
                            <th data-field="title">{{ trans('cms::app.name') }}</th>
                            <th data-field="type" data-width="15%">{{ trans('cms::app.type') }}</th>
                            <th data-width="20%" data-formatter="actions_formatter">{{ trans('cms::app.actions') }}</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>


    <script type="text/javascript">
        let linkModule = "{{ route('admin.translations.type', ['__KEY__']) }}";

        function index_formatter(value, row, index) {
            return (index + 1);
        }

        function actions_formatter(value, row, index) {
            return `<a href="${linkModule.replace('__KEY__', row.key)}" class="btn btn-tabler"><span><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-language"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 5h7" /><path d="M9 3v2c0 4.418 -2.239 8 -5 8" /><path d="M5 9c0 2.144 2.952 3.908 6.7 4" /><path d="M12 20l4 -9l4 9" /><path d="M19.1 18h-6.2" /></svg></span> ${mojar.lang.translate}</a>`;
        }

        let table = new MojarTable({
            url: '{{ route('admin.translations.get-data') }}',
            search: true,
        });
    </script>
@endsection
