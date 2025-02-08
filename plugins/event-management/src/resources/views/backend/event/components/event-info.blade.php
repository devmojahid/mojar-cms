@php
    /**
     * @var \Juzaweb\Backend\Models\Post $model
     * @var \Juzaweb\evmanmerce\Models\ProductVariant $variant
     */
@endphp



<div class="card mt-3 mb-3">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
            <li class="nav-item">
                <a href="#tabs-event-info" class="nav-link active" data-bs-toggle="tab">
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
                    Event Info
                </a>
            </li>
            <li class="nav-item">
                <a href="#tabs-brand-area" class="nav-link" data-bs-toggle="tab">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24"

                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <circle cx="12" cy="7" r="4" />
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                    </svg>
                    Brand Area
                </a>
            </li>
            <li class="nav-item">
                <a href="#tabs-tickets" class="nav-link" data-bs-toggle="tab">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24"


                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <circle cx="12" cy="7" r="4" />
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                    </svg>
                   Tickets
                </a>
            </li>
            <li class="nav-item">

                <a href="#tabs-social-information" class="nav-link" data-bs-toggle="tab">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">

                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <circle cx="12" cy="7" r="4" />
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                    </svg> 
                    Social Information
                </a>
            </li>
        </ul>

    </div>
    <div class="card-body">
        <div class="tab-content">
            <div class="tab-pane active show" id="tabs-event-info">
                <h4>Date & Time</h4>
                <div>
                    <div class="row">
                        <div class="col-md-6">
                            {{ Field::text(trans('evman::content.start_date'), 'meta[start_date]', [
                                'value' => $model->getMeta('start_date') ? number_format($model->getMeta('start_date')) : '',
                                'class' => 'form-control',
                                'type' => 'datetime-local',
                                'id' => 'datepicker-default',
                            ]) }}

                        </div>

                        <div class="col-md-6">
                            {{ Field::text(trans('evman::content.end_date'), 'meta[end_date]', [
                                'value' => $model->getMeta('end_date') ? number_format($model->getMeta('end_date')) : '',
                                'class' => 'is-number number-format',
                                'type' => 'datetime-local',
                                'id' => 'datepicker-default',
                            ]) }}
                        </div>
                    </div>

                    <h4>Bookings</h4>
                    
                    <div class="row">
                        <div class="col-md-6">

                            {{ Field::text(trans('evman::content.price'), 'meta[price]', [
                                'value' => $model->getMeta('price') ? number_format($model->getMeta('price')) : '',
                                'class' => 'is-number number-format',
                                'prefix' => '$',
                            ]) }}
                        </div>

                        <div class="col-md-6">
                            {{ Field::text(trans('evman::content.compare_price'), 'meta[compare_price]', [
                                'value' => $model->getMeta('compare_price') ? number_format($model->getMeta('compare_price')) : '',
                                'class' => 'is-number number-format',
                                'prefix' => '$',
                            ]) }}

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            {{ Field::text(trans('evman::content.sku_code'), 'meta[sku_code]', [
                                'value' => $model->getMeta('sku_code') ?? '',
                            ]) }}
                        </div>


                        <div class="col-md-6">
                            {{ Field::text(trans('evman::content.barcode'), 'meta[barcode]', [
                                'value' => $model->getMeta('barcode') ?? '',
                            ]) }}
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            {{ Field::checkbox(trans('evman::content.inventory_management'), 'meta[inventory_management]', [
                                'checked' => $model->getMeta('inventory_management') == 1,
                            ]) }}

                            {{ Field::text(trans('evman::content.quantity'), 'meta[quantity]', [
                                'value' => $model->getMeta('quantity') ?? '',
                                'class' => 'is-number number-format',
                            ]) }}

                            {{ Field::checkbox(trans('evman::content.allows_ordering_out_of_stock'), 'meta[disable_out_of_stock]', [
                                'checked' => $model->getMeta('disable_out_of_stock') == 1,
                            ]) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tabs-brand-area">
                <h4>Brand Area tab</h4>
                <div>

                    {{ Field::images(trans('evman::content.images'), 'meta[images]', [
                        'value' => $model->getMeta('images', []),
                    ]) }}
                </div>
            </div>

            <div class="tab-pane" id="tabs-tickets">
                <h4>Tickets tab</h4>
                <div>
                    {{ Field::images(trans('evman::content.images'), 'meta[images]', [
                        'value' => $model->getMeta('images', []),
                    ]) }}
                </div>
            </div>
            <div class="tab-pane" id="tabs-social-information">
                <h4>Social Information tab</h4>
                <div>
                    {{ Field::repeater(
                        trans('evman::content.social_links'), 
                        'meta[social_links]', 
                        [
                            [
                                'name' => 'icon',
                                'type' => 'text',
                                'label' => 'Icon Class',
                                'description' => 'FontAwesome icon class (e.g. fab fa-facebook-f)',
                                'placeholder' => 'fab fa-facebook-f'
                            ],
                            [
                                'name' => 'url',
                                'type' => 'text',
                                'label' => 'Social Link URL',
                                'placeholder' => 'https://'
                            ]
                        ],
                        [
                            'min_items' => 1,
                            'max_items' => 6,
                            'add_button_text' => 'Add Social Link',
                            'remove_button_text' => 'Remove Link'
                        ]
                    ) }}
                </div>
            </div>
        </div>
    </div>
</div>
