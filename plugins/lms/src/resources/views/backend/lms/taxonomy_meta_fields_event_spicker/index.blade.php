@php
    /**
     * @var \Juzaweb\Backend\Models\Taxonomy $model
     * @var array $metas
     */
@endphp

<div class="card mt-3 mb-3">
    <div class="card-header">
        <div class="d-flex flex-column justify-content-center">
            <h5 class="mb-0">{{ __('Event Spicker Info') }}</h5>
        </div>
    </div>
    <div class="card-body">
        @foreach ($metas as $key => $meta)
            <div class="row">
                <div class="col-md-6">
                    @if ($meta['type'] === 'text')
                        {{ Field::text($meta['label'], "meta[{$key}]", [
                            'value' => $model->getMeta($key) ?? '',
                            'placeholder' => $meta['label'],
                        ]) }}
                    @elseif ($meta['type'] === 'image')
                        {{ Field::images($meta['label'], "meta[{$key}]", [
                            'value' => $model->getMeta($key, []),
                        ]) }}
                    @elseif ($meta['type'] === 'checkbox')
                        {{ Field::checkbox($meta['label'], "meta[{$key}]", [
                            'checked' => $model->getMeta($key) == 1,
                        ]) }}
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>