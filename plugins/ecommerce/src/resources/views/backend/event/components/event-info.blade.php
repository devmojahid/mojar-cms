@php
    /**
     * @var \Juzaweb\Backend\Models\Post $model
     * @var \Juzaweb\merce\Models\ProductVariant $variant
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
                            {{ Field::text(trans('ecomm::content.start_date'), 'meta[start_date]', [
                                'value' => $model->getMeta('start_date') ? $model->getMeta('start_date') : '',
                                'class' => 'form-control',
                                'type' => 'datetime-local',
                                'id' => 'datepicker-default',
                            ]) }}

                        </div>

                        <div class="col-md-6">
                            {{ Field::text(trans('ecomm::content.end_date'), 'meta[end_date]', [
                                'value' => $model->getMeta('end_date') ? $model->getMeta('end_date') : '',
                                'class' => 'is-number number-format',
                                'type' => 'datetime-local',
                                'id' => 'datepicker-default',
                            ]) }}

                        </div>
                    </div>
                </div>

                <h4>Event Location & Venue</h4>
                <div>
                    <div class="row">
                        <div class="col-md-6">
                            {{ Field::text(trans('ecomm::content.venue'), 'meta[venue]', [
                                'value' => $model->getMeta('venue'),
                            ]) }}
                        </div>
                        <div class="col-md-6">

                            {{ Field::text(trans('ecomm::content.venue_address'), 'meta[venue_address]', [
                                'value' => $model->getMeta('venue_address'),
                            ]) }}
                        </div>
                        <div class="col-md-6">
                            {{ Field::text(trans('ecomm::content.latitude'), 'meta[latitude]', [
                                'value' => $model->getMeta('latitude'),
                            ]) }}
                        </div>
                        <div class="col-md-6">
                            {{ Field::text(trans('ecomm::content.longitude'), 'meta[longitude]', [
                                'value' => $model->getMeta('longitude'),
                            ]) }}
                        </div>
                        <div class="col-md-6">
                            {{ Field::text(trans('ecomm::content.map_url'), 'meta[map_url]', [
                                'value' => $model->getMeta('map_url'),
                            ]) }}
                        </div>
                        <div class="col-md-6">
                            {{ Field::text(trans('ecomm::content.map_embed_code'), 'meta[map_embed_code]', [
                                'value' => $model->getMeta('map_embed_code'),
                            ]) }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="tabs-brand-area">
                <h4>Brand Area tab</h4>
                <div>
                    <div class="row">
                        <div class="col-md-6">
                            {{ Field::image(trans('ecomm::content.event_logo'), 'meta[event_logo]', [
                                'value' => $model->getMeta('event_logo'),
                                'data' => [
                                    'show_label' => true,
                                ],
                            ]) }}
                        </div>
                        <div class="col-md-6">

                            {{ Field::image(trans('ecomm::content.event_banner'), 'meta[event_banner]', [
                                'value' => $model->getMeta('event_banner'),
                                'data' => [
                                    'show_label' => true,
                                ],
                            ]) }}
                        </div>
                    </div>

                </div>
            </div>


            <div class="tab-pane" id="tabs-tickets">
                <h4>Tickets tab</h4>
                <div class="row">
                    <div class="col-md-6">
                        {{ Field::text(trans('ecomm::content.name'), 'meta[name]', [
                            'value' => $eventTicket->name ?? '',
                        ]) }}
                    </div>

                    <div class="col-md-6">

                        {{ Field::textarea(trans('ecomm::content.description'), 'meta[description]', [
                            'value' => $eventTicket->description ?? '',
                        ]) }}
                    </div>


                    <div class="col-md-6">
                        {{ Field::text(trans('ecomm::content.price'), 'meta[price]', [
                            'value' => $eventTicket->price ? number_format($eventTicket->price) : '',
                            'type' => 'number',
                            'prefix' => '$'
                        ]) }}

                    </div>

                    <div class="col-md-6">
                        {{ Field::text(trans('ecomm::content.capacity'), 'meta[capacity]', [
                            'value' => $eventTicket->capacity ?? '',
                            'type' => 'number',
                        ]) }}

                    </div>

                    <div class="col-md-6">
                        {{ Field::text(trans('ecomm::content.min_ticket_number'), 'meta[min_ticket_number]', [
                            'value' => $eventTicket->min_ticket_number ?? '',
                            'type' => 'number',
                        ]) }}


                    </div>
                    
                    <div class="col-md-6">
                        {{ Field::text(trans('ecomm::content.max_ticket_number'), 'meta[max_ticket_number]', [
                            'value' => $eventTicket->max_ticket_number ?? '',
                            'type' => 'number',
                        ]) }}


                    </div>

                    <div class="col-md-6">
                        {{ Field::text(trans('ecomm::content.start_date'), 'meta[start_date]', [
                            'value' => $eventTicket->start_date ?? '',
                            'type' => 'datetime-local',
                        ]) }}


                    </div>

                    <div class="col-md-6">
                        {{ Field::text(trans('ecomm::content.end_date'), 'meta[end_date]', [
                            'value' => $eventTicket->end_date ?? '',
                            'type' => 'datetime-local',
                        ]) }}


                    </div>
                </div>
            </div>

            <div class="tab-pane" id="tabs-social-information">
                <h4>Social Information tab</h4>

                <div>
                    @php
                        $socialLinks = $model->getMeta('social_links');
                        if (empty($socialLinks)) {
                            $socialLinks = [
                                [
                                    'icon' => 'fab fa-facebook-f',
                                    'url' => '#',
                                ],
                            ];
                        } elseif (!is_array(reset($socialLinks))) {
                            $socialLinks = [$socialLinks];
                        }
                    @endphp
                
                    {{ Field::repeater(
                        trans('ecomm::content.social_links'),
                        'meta[social_links]',
                        [
                            [
                                'name' => 'icon',
                                'type' => 'text',
                                'label' => 'Icon Class',
                                'description' => 'FontAwesome icon class (e.g. fab fa-facebook-f)',
                                'placeholder' => 'fab fa-facebook-f',
                            ],
                            [
                                'name' => 'url',
                                'type' => 'text',
                                'label' => 'Social Link URL',
                                'placeholder' => 'https://',
                            ],
                        ],
                        [
                            'min_items' => 1,
                            'max_items' => 6,
                            'add_button_text' => 'Add Social Link',
                            'remove_button_text' => 'Remove Link',
                            'collapsible' => true,
                            'sortable' => true,
                            'value' => $socialLinks, // Try adding value here as well
                        ],
                        $socialLinks
                    ) }}
                </div>
            </div>
        </div>
    </div>
</div>
