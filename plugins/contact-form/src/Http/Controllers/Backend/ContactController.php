<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/juzacms
 * @author     Juzaweb Team <admin@juzaweb.com>
 * @link       https://juzaweb.com
 * @license    MIT
 */

namespace Mojahid\ContactForm\Http\Controllers\Backend;

use Juzaweb\CMS\Traits\ResourceController;
use Illuminate\Support\Facades\Validator;
use Juzaweb\Backend\Http\Controllers\Backend\PageController;
use Juzaweb\CMS\Abstracts\DataTable;
use Mojahid\ContactForm\Http\Datatables\ContactDatatable;
use Mojahid\ContactForm\Models\Contact;
use Illuminate\Contracts\Validation\Validator as ValidatorContract;

class ContactController extends PageController
{
    use ResourceController;

    protected string $viewPrefix = 'contact_form::backend.contact';

    protected function getDataTable(...$params): DataTable
    {
        return new ContactDatatable();
    }

    protected function validator(array $attributes, ...$params): ValidatorContract
    {
        return Validator::make(
            $attributes,
            [
                // Rules
            ]
        );
    }

    protected function getModel(...$params): string
    {
        return Contact::class;
    }

    protected function getTitle(...$params): string
    {
        return trans('contact_form::content.contact');
    }
}
