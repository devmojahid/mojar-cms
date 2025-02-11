@extends('cms::layouts.backend')

@section('content')
    @component('cms::components.form_resource', [
        'model' => $model
    ])
        @if($model->id)
            @include('ecomm::backend.order.components.form_update')
        @else
            @include('ecomm::backend.order.components.form_create')
        @endif
    @endcomponent
@endsection
