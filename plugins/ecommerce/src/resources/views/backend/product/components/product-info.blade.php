@php
    /**
     * @var \Juzaweb\Backend\Models\Post $model
     * @var \Juzaweb\merce\Models\ProductVariant $variant
     */

     $downloadLinks = \Mojahid\Ecommerce\Models\DownloadLink::where(['variant_id' => $variant->id])->get();
@endphp



<div class="card mt-3 mb-3">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
            <li class="nav-item">
                <a href="#tabs-product-info" class="nav-link active" data-bs-toggle="tab">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-check">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M11.5 21h-5.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v6" />
                        <path d="M16 3v4" />
                        <path d="M8 3v4" />
                        <path d="M4 11h16" />
                        <path d="M15 19l2 2l4 -4" />
                    </svg>
                    {{ __('Product Info') }}
                </a>
            </li>
            <li class="nav-item d-none">
                <a href="#tabs-brand-area" class="nav-link" data-bs-toggle="tab">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <circle cx="12" cy="7" r="4" />
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                    </svg>
                    {{ __('Advanced') }}
                </a>
            </li>
            <li class="nav-item d-none">
                <a href="#tabs-media-area" class="nav-link" data-bs-toggle="tab">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                        <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                        <path d="M9 17h6" />
                    </svg>
                    {{ __('Media') }}
                </a>
            </li>            
        </ul>

    </div>
    <div class="card-body">
        <div class="tab-content">
            <div class="tab-pane active show" id="tabs-product-info">
                <h4>Date & Time</h4>
                <div>
                    <div class="row">
                        <div class="col-md-6">
                            {{ Field::text(trans('ecomm::content.price'), 'meta[price]', [
                                'value' => $variant->price ? number_format($variant->price) : '',
                                'class' => 'is-number number-format',
                                'prefix' => '$',
                            ]) }}

                        </div>

                        <div class="col-md-6">
                            {{ Field::text(trans('ecomm::content.compare_price'), 'meta[compare_price]', [
                                'value' => $variant->compare_price ? number_format($variant->compare_price) : '',
                                'class' => 'is-number number-format',
                                'prefix' => '$',
                            ]) }}
                        </div>
                    </div>
                </div>

                <div>
                    <div class="row">
                        <div class="col-md-6">
                            {{ Field::text(trans('ecomm::content.sku_code'), 'meta[sku_code]', [
                                'value' => $variant->sku_code ?? '',
                            ]) }}
                        </div>

                        <div class="col-md-6">
                            {{ Field::text(trans('ecomm::content.barcode'), 'meta[barcode]', [
                                'value' => $variant->barcode ?? '',
                            ]) }}
                        </div>

                        <div class="col-md-6">
                            {{ Field::checkbox(trans('ecomm::content.inventory_management'), 'meta[inventory_management]', [
                                'checked' => $model->getMeta('inventory_management') == 1,
                            ]) }}

                            {{ Field::text(trans('ecomm::content.quantity'), 'meta[quantity]', [
                                'value' => $model->getMeta('quantity') ?? '',
                                'class' => 'is-number number-format',
                            ]) }}

                            {{ Field::checkbox(trans('ecomm::content.allows_ordering_out_of_stock'), 'meta[disable_out_of_stock]', [
                                'checked' => $model->getMeta('disable_out_of_stock') == 1,
                            ]) }}
                        </div>

                    </div>
                </div>
            </div>

            <div class="tab-pane" id="tabs-brand-area">
                <h4>
                    {{ __('Download Links') }}
                </h4>
                <div>
                    {{ Field::checkbox(trans('Downloadable'), 'meta[downloadable]', ['checked' => $model->getMeta('downloadable') == 1]) }}

                    <div class="row download-links-box form-repeater">

                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="w-25">{{ trans('File Name') }}</th>
                                    <th>{{ trans('File Url') }}</th>
                                </tr>
                                </thead>
                                <tbody class="repeater-items">
                                @foreach($downloadLinks as $downloadLink)
                                    @component(
                                        'ecomm::backend.product.components.download-link-item',
                                        ['marker' => $downloadLink->id, 'item' => $downloadLink]
                                    )
            
                                    @endcomponent
                                @endforeach
                                </tbody>
                            </table>
                        </div>
            
                        <div class="col-md-12">
                            <button type="button" class="btn btn-primary btn-sm add-repeater-item">
                                {{ trans('cms::app.add_repeater_item', ['label' => trans('Download Links')]) }}
                            </button>
                        </div>
            
                        <script type="text/html" class="repeater-item-template">
                            @component('ecomm::backend.product.components.download-link-item', ['marker' => '{marker}'])
            
                            @endcomponent
                        </script>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="tabs-media-area">
                <h4>
                    {{ __('Media') }}
                </h4>
                {{ Field::images(trans('ecomm::content.images'), 'meta[images]', [
                    'value' => $model->getMeta('images', []),
                    'data' => [
                        'show_label' => true,
                    ],
                ]) }}
            </div>
        </div>
    </div>
</div>
