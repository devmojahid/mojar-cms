<?php

namespace Juzaweb\Backend\Http\Controllers\Backend;

use Juzaweb\CMS\Http\Controllers\BackendController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Juzaweb\CMS\Traits\ResourceController;
use Juzaweb\Backend\Http\Datatables\PaymentMethodDatatable;
use Juzaweb\CMS\Models\PaymentMethod;

class PaymentMethodController extends BackendController
    {
        use ResourceController {
            getDataForForm as DataForForm;
        }

        protected string $viewPrefix = 'cms::backend.payment-method';

        protected function getDataTable(...$params): PaymentMethodDatatable
        {
            return new PaymentMethodDatatable();
        }

        protected function validator(array $attributes, ...$params): \Illuminate\Validation\Validator
        {
            $types = config('mojar.payment_methods');

            // dd($types);
            $types = array_keys($types);

            return Validator::make(
                $attributes,
                [
                    'type' => [
                        'required_if:id,',
                        Rule::in($types)
                    ],
                    'name' => [
                        'required'
                    ]
                ]
            );
        }

        protected function getModel(...$params): string
        {
            return PaymentMethod::class;
        }

        protected function getTitle(...$params): string
        {
            return trans('cms::app.payment_methods');
        }


        protected function getDataForForm($model, ...$params): array
        {
            $data = $this->DataForForm($model);
            $data['methods'] = trans('cms::app.data.payment_methods');
            return $data;
        }


        protected function parseDataForSave(array $attributes, ...$params): array
        {
            $attributes['active'] = $attributes['active'] ?? 0;

            return $attributes;
        }
    }
