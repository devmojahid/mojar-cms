<h5>{{__('Store Address')}}</h5>
<div class="row">
    <div class="col-md-12">
        @php
            $pages = \Juzaweb\Backend\Models\Post::whereType('pages')
                ->get(['id', 'title'])
                ->mapWithKeys(function ($item) {
                    return [$item->id => $item->title];
                })
                ->toArray();
            $pages = array_replace(['' => __('Select page')], $pages);
        @endphp

        {{ Field::select(__('Checkout Page'), 'evman_checkout_page', [
            'value' => get_config('evman_checkout_page'),
            'options' => $pages,
        ]) }}

        {{ Field::select(__('Thanks Page'), 'evman_thanks_page', [
            'value' => get_config('evman_thanks_page'),
            'options' => $pages,
        ]) }}

    </div>
</div>

