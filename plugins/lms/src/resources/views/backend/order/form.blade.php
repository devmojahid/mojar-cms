@extends('cms::layouts.backend')

@section('content')
    @component('cms::components.form_resource', [
        'model' => $model
    ])
        @if($model->id)
            @include('lms::backend.order.components.form_update')
        @else
            @include('lms::backend.order.components.form_create')
        @endif
    @endcomponent
@endsection
