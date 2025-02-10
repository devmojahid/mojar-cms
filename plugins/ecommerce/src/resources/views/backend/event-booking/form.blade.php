@extends('cms::layouts.backend')

@section('content')
    @component('cms::components.form_resource', [
        'model' => $model
    ])
        @if($model->id)
            @include('ecomm::backend.event-booking.components.form_update')
        @else
            @include('ecomm::backend.event-booking.components.form_create')
        @endif
    @endcomponent
@endsection
