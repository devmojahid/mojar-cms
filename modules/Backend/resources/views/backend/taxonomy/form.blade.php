@extends('cms::layouts.backend')

@section('content')
    @php
        $type = $setting->get('type');
        $postType = $setting->get('post_type');
    @endphp

    @component('cms::components.form_resource', [
        'model' => $model,
    ])
        <div class="row">
            <div class="col-md-12">

                {{ Field::text($model, 'name', [
                    'required' => true,
                ]) }}

                {{ Field::textarea($model, 'description') }}

                @if (in_array('hierarchical', $setting->get('supports', [])))
                    <div class="form-group">
                        <label class="col-form-label" for="parent_id">{{ trans('cms::app.parent') }}</label>
                        <select name="parent_id" id="parent_id" class="form-control load-taxonomies"
                            data-post-type="{{ $setting->get('post_type') }}" data-taxonomy="{{ $setting->get('taxonomy') }}"
                            data-placeholder="{{ trans('cms::app.parent') }}" data-explodes="{{ $model->id }}">
                            @if ($model->parent)
                                <option value="{{ $model->parent->id }}" selected>{{ $model->parent->name }}</option>
                            @endif
                        </select>
                    </div>
                @endif
            </div>

            @if (in_array('thumbnail', $setting->get('supports', [])))
                <div class="col-md-4">
                    @component('cms::components.form_image', [
                        'name' => 'thumbnail',
                        'label' => trans('cms::app.thumbnail'),
                        'value' => $model->thumbnail,
                    ])
                    @endcomponent
                </div>
            @endif

            @if (!empty($setting->get('metas')))
                @foreach($setting->get('metas') as $metaKey => $metaArgs)
                    @if($metaArgs['visible'] ?? true)
                        {{ Field::fieldByType([
                            'type' => $metaArgs['type'] ?? 'text',
                            'name' => 'meta[' . $metaKey . ']',
                            'label' => $metaArgs['label'],
                            'value' => $model->getMeta($metaKey),
                            'placeholder' => $metaArgs['placeholder'] ?? '',
                            'description' => $metaArgs['description'] ?? '',
                            'required' => $metaArgs['required'] ?? false,
                            'options' => $metaArgs['options'] ?? [],
                            'data' => [
                                'value' => $model->getMeta($metaKey)
                            ]
                        ]) }}
                    @endif
                @endforeach
            @endif

            <input type="hidden" name="post_type" value="{{ $postType }}">
            <input type="hidden" name="taxonomy" value="{{ $taxonomy }}">

            @do_action('taxonomy.' . $taxonomy . '.form.bottom', $model)
        </div>
    @endcomponent

@endsection
