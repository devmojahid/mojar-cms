@extends('cms::layouts.backend')

@section('breadcrumb-right')
<div class="col-auto mb-3">
    <div class="btn-group float-right">
        <a href="javascript:void(0)" class="btn btn-tabler" data-toggle="modal"
            data-target="#modal-add">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M12 5l0 14" />
                <path d="M5 12l14 0" />
            </svg>
            {{ trans('cms::app.add_language') }}
        </a>
    </div>
</div>
@endsection

@section('content')

    <div class="card mb-2">
        <div class="card-body">
            <div class="table-responsive mb-5">
                <table class="table mojar-table">
                    <thead>
                        <tr>
                            <th data-field="index" data-width="3%" data-formatter="index_formatter" data-align="center">#
                            </th>
                            <th data-width="10%" data-field="code">{{ trans('cms::app.language_code') }}</th>
                            <th data-field="name">{{ trans('cms::app.language') }}</th>
                            <th data-width="20%" data-formatter="actions_formatter">{{ trans('cms::app.actions') }}</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    {{-- <div class="modal fade" id="modal-add" role="dialog" aria-labelledby="modal-add-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="{{ route('admin.translations.type.add', [$type]) }}" class="form-ajax"
                data-success="add_language_success" data-notify="true">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-add-title">{{ trans('cms::app.add_language') }}</h5>
                        <button type="button" class="close" data-dismiss="modal"
                            aria-label="{{ trans('cms::app.close') }}">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label>{{ trans('cms::app.language') }}</label>
                            <select name="locale" id="locale" class="load-locales"
                                data-placeholder="--- {{ trans('cms::app.language') }} ---"></select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{ trans('cms::app.add') }}</button>
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ trans('cms::app.close') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div> --}}


<div class="modal fade language-modal" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="modal-add-title" aria-hidden="true">
    <form method="post" action="{{ route('admin.translations.type.add', [$type]) }}" class="form-ajax" data-success="add_language_success" data-notify="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-add-title">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M4 5h7" />
                            <path d="M9 3v2c0 4.418 -2.239 8 -5 8" />
                            <path d="M5 9c0 2.144 2.952 3.908 6.7 4" />
                            <path d="M12 20l4 -9l4 9" />
                            <path d="M19.1 18h-6.2" />
                        </svg>
                        {{ trans('cms::app.add_language') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ trans('cms::app.close') }}"></button>
                </div>

                <div class="modal-body py-4 language-modal-body">
                    <div class="mb-3">
                        <label class="form-label required">{{ trans('cms::app.language') }}</label>
                        <select name="locale" id="locale" class="form-select load-locales"
                            data-placeholder="--- {{ trans('cms::app.language') }} ---"></select>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="w-100">
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn w-100" data-bs-dismiss="modal">
                                    {{ trans('cms::app.close') }}
                                </button>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-primary w-100">
                                    {{ trans('cms::app.add') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>


    <script type="text/javascript">
        let linkLocale = "{{ route('admin.translations.locale', [$type, '__LOCALE__']) }}";

        function add_language_success(form, response) {
            setTimeout(function() {
                window.location = "";
            }, 300);
        }

        function index_formatter(value, row, index) {
            return (index + 1);
        }

        function actions_formatter(value, row, index) {
            return `<a href="${linkLocale.replace('__LOCALE__', row.code)}" class="btn btn-tabler"><span><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-language"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 5h7" /><path d="M9 3v2c0 4.418 -2.239 8 -5 8" /><path d="M5 9c0 2.144 2.952 3.908 6.7 4" /><path d="M12 20l4 -9l4 9" /><path d="M19.1 18h-6.2" /></svg></span> ${mojar.lang.translate}</a>`;
        }

        let table = new MojarTable({
            url: '{{ route('admin.translations.type.get-data', [$type]) }}',
        });
    </script>
@endsection
