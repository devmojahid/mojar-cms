@extends('cms::layouts.backend')

@section('content')
    @component('cms::components.form_resource', [
        'model' => $model
    ])

        <div class="row">
            <div class="col-md-12">

                <div class="row">
                    <div class="col-md-6">
                        {{ Field::text($model, 'name', ['label' => trans('contact_form::content.name')]) }}
                    </div>

                    <div class="col-md-6">
                        {{ Field::text($model, 'email', ['label' => trans('contact_form::content.email')]) }}
                    </div>
                </div>

                {{ Field::text($model, 'subject', ['label' => trans('contact_form::content.subject')]) }}


                {{ Field::textarea($model, 'message', ['label' => trans('contact_form::content.message'), 'rows' => 5]) }}


            </div>
        </div>

    @endcomponent
@endsection
