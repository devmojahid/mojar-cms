<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    GNU General Public License v2.0
 */

namespace Juzaweb\API\Actions;

use Juzaweb\API\Support\Documentation\AuthSwaggerDocumentation;
use Juzaweb\API\Support\Documentation\PostTypeAdminSwaggerDocumentation;
use Juzaweb\API\Support\Documentation\PostTypeSwaggerDocumentation;
use Juzaweb\API\Support\Swagger\SwaggerDocument;
use Juzaweb\CMS\Abstracts\Action;

class APIAction extends Action
{
    public function handle()
    {
        $this->addAction(Action::BACKEND_INIT, [$this, 'addAdminMenu']);
        if (config('mojar.api.frontend.enable')) {
            $this->addAction(Action::API_DOCUMENT_INIT, [$this, 'addAPIDocumentation'], 1);
        }
    }

    public function addAPIDocumentation()
    {
        $document = SwaggerDocument::make('frontend');
        $document->setTitle('Frontend');
        $document->append(AuthSwaggerDocumentation::class);
        $document->append(PostTypeSwaggerDocumentation::class);
        $this->hookAction->registerAPIDocument($document);
    }

    public function addAdminDocumentation()
    {
        $apiAdmin = SwaggerDocument::make('admin');
        $apiAdmin->setTitle('Admin');
        $apiAdmin->setPrefix('admin');
        $apiAdmin->append(PostTypeAdminSwaggerDocumentation::class);
        $this->hookAction->registerAPIDocument($apiAdmin);
    }

    public function addAdminMenu()
    {
        // $this->hookAction->registerAdminPage(
        //     'api.documentation',
        //     [
        //         'title' => trans('cms::app.api_documentation'),
        //         'menu' => [
        //             'icon' => 'fa fa-book',
        //             'position' => 95,
        //         ],
        //     ]
        // );
    }
}
