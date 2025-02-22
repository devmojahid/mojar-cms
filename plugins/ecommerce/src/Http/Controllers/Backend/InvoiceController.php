<?php

namespace Mojahid\Ecommerce\Http\Controllers\Backend;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Juzaweb\CMS\Http\Controllers\BackendController;
use Juzaweb\CMS\Traits\ResourceController;
use Mojahid\Ecommerce\Http\Datatables\OrderDatatable;
use Mojahid\Ecommerce\Models\Order;
use Juzaweb\CMS\Models\PaymentMethod;

class InvoiceController extends BackendController
{
    //
}