@extends('cms::layouts.editor')

@section('content')
    <div class="row">
        <div class="col-md-9">
            @component('cms::components.card', [
                'label' => trans('cms::app.post_create')
            ])
                <div class="row">
                    <div class="col-md-12">
                        {{ Field::text($model, 'title', [
                            'required' => true,
                            'class' => empty($model->slug) ? 'generate-slug' : '',
                            'placeholder' => 'Enter title here...'
                        ]) }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        {{ Field::slug($model, 'slug') }}
                    </div>
                </div>

                @include($editor)

            @endcomponent

            @php
                /** @var \Illuminate\Support\Collection $setting */
                $metas = collect_metas($setting->get('metas'))
                            ->where('sidebar', false)
                            ->where('visible', true)
                            ->toArray();
            @endphp

            @foreach($metas as $name => $meta)
                @php
                    $meta['name'] = "meta[{$name}]";
                    $meta['data']['value'] = $model->getMeta($name);
                @endphp

                {{ Field::fieldByType($meta) }}
            @endforeach

            {{ Field::render($setting->get('fields', []), $model) }}

                @do_action('post_type.'. $postType .'.form.left', $model)

                @do_action('post_types.form.left', $model)
        </div>

        <div class="col-md-3">
            <div class="form-group">
                @component('cms::components.card', [
                    'label' => trans('cms::app.content_publish')
                ])
                    <div class="row g-2 align-items-center">
                        <div class="col-6">
                            <button type="submit" class="btn btn-tabler w-100">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" />
                                </svg> 
                                {{ trans('cms::app.save') }}
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-teal w-100 cancel-button">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-refresh"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" /><path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" /></svg>
                                {{ trans('cms::app.reset') }}
                            </button>
                        </div>
                    </div>
                @endcomponent
            </div>
            <div class="form-group">
                @component('cms::components.card', [
                    'label' => trans('cms::app.status')
                ])
                    {{ Field::select($model, 'status', [
                        'options' => $model->getStatuses()
                    ]) }}
                @endcomponent
            </div>
            <div class="form-group">
                @component('cms::components.card', [
                    'label' => trans('cms::app.thumbnail')
                ])
                    {{ Field::image($model, 'thumbnail') }}
                @endcomponent
            </div>

            @php
                $metas = collect_metas($setting->get('metas'))
                    ->where('sidebar', true)
                    ->where('visible', true)
                    ->toArray();
            @endphp

            @foreach($metas as $name => $meta)
                @php
                    $meta['name'] = "meta[{$name}]";
                    $meta['data']['value'] = $model->getMeta($name);
                @endphp
                {{ Field::fieldByType($meta) }}

            @endforeach

            @do_action('post_types.form.right', $model)

            {{-- show texonomies --}}
            
            @do_action('post_type.'. $postType .'.form.right', $model)
        </div>
    </div>
@endsection
