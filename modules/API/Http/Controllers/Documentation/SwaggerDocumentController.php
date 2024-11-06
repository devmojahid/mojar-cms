<?php

/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    GNU General Public License v2.0
 */

namespace Mojar\API\Http\Controllers\Documentation;

use Illuminate\Http\JsonResponse;
use Mojar\CMS\Abstracts\Action;
use Mojar\CMS\Contracts\HookActionContract as HookAction;
use Mojar\CMS\Http\Controllers\BackendController;

class SwaggerDocumentController extends BackendController
{
    public function __construct(protected HookAction $hookAction)
    {
        do_action(Action::API_DOCUMENT_INIT);
    }

    public function index(string $document): JsonResponse
    {
        $documentation = $this->hookAction->getAPIDocuments($document);

        if (empty($documentation)) {
            abort(404);
        }

        return response()->json(
            $documentation,
            200,
            [],
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
        );
    }
}
