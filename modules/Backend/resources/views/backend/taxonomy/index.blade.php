@extends('cms::layouts.backend')

@section('content')
    <div class="row g-3 align-items-center mb-3">
        <div class="col-auto">
            <span class="status-indicator status-blue status-indicator-animated">
                <span class="status-indicator-circle"></span>
                <span class="status-indicator-circle"></span>
                <span class="status-indicator-circle"></span>
            </span>
        </div>
        <div class="col">
            <h2 class="page-title">
                {{ $setting->get('label') }}
            </h2>
        </div>
        <div class="col-md-auto ms-auto d-print-none">
            @if ($canCreate)
                <button type="button" class="btn btn-tabler" data-toggle="add-new-form">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 5l0 14" />
                        <path d="M5 12l14 0" />
                    </svg>
                    {{ trans('cms::app.add_new') }}
                </button>
            @endif
        </div>
    </div>
    <div class="row mb-3">
        @if ($canCreate)
            <div class="form-group add-new-form d-none">
                @component('cms::components.card', [
                        'label' => trans('cms::app.add_new') . ' ' . trans($setting->get('label'))
                    ])
                    <div class="col-md-12">
                        @php
                            $type = $setting->get('type');
                            $postType = $setting->get('post_type');
                            $metas = $setting->get('metas');
                        @endphp

                        <form method="post" action="{{ route('admin.taxonomies.store', [$postType, $taxonomy]) }}"
                            class="form-ajax" data-success="reload_data" id="form-add">

                            @component('cms::components.form_input', [
                                'name' => 'name',
                                'label' => trans('cms::app.name'),
                                'value' => '',
                                'required' => true,
                            ])
                            @endcomponent

                            @component('cms::components.form_textarea', [
                                'name' => 'description',
                                'rows' => '3',
                                'label' => trans('cms::app.description'),
                                'value' => '',
                            ])
                            @endcomponent

                            @if (in_array('hierarchical', $setting->get('supports', [])))
                                <div class="form-group">
                                    <label class="col-form-label" for="parent_id">{{ trans('cms::app.parent') }}</label>
                                    <select name="parent_id" id="parent_id" class="form-control load-taxonomies"
                                        data-post-type="{{ $setting->get('post_type') }}"
                                        data-taxonomy="{{ $setting->get('taxonomy') }}"
                                        data-placeholder="{{ trans('cms::app.parent') }}">
                                    </select>
                                </div>
                            @endif

                            @if(in_array('thumbnail', $setting->get('supports', [])))
                            <div class="col-md-4">
                                @component('cms::components.form_image', [
                                    'name' => 'thumbnail',
                                    'label' => trans('cms::app.thumbnail')
                                ])@endcomponent
                            </div>
                            @endif

                            @if (!empty($metas))
                                @foreach ($metas as $meta => $metaArgs)
                                    @component('cms::components.form_input', [
                                        'name' => $meta,
                                        'label' => $metaArgs['label'], 
                                        'value' => '',
                                        'required' => true,
                                    ])

                                    @endcomponent
                                @endforeach
                            @endif



                            <input type="hidden" name="post_type" value="{{ $postType }}">
                            <input type="hidden" name="taxonomy" value="{{ $taxonomy }}">

                            <button type="submit" class="btn btn-tabler float-end">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg>
                                {{ trans('cms::app.add') }} {{ $setting->get('label') }}
                            </button>
                        </form>
                    </div>
                @endcomponent
            </div>
        @endif

        <div class="col-md-12">
            {{ $dataTable->render() }}
        </div>
    </div>

    <script type="text/javascript">
        function reload_data(form) {
            $('#form-add input[type="text"], #form-add textarea').val(null);
            $('#form-add #parent_id').val(null).trigger('change.select2');
            table.refresh();
        }

        $(document).ready(function() {
            $('[data-toggle="add-new-form"]').click(function() {
                $('.add-new-form').toggleClass('d-none');
            });
        });
    </script>

@endsection
