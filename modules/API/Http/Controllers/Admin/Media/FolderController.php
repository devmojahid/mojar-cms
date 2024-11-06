<?php

/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    GNU General Public License v2.0
 */

namespace Mojar\API\Http\Controllers\Admin\Media;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Mojar\Backend\Repositories\MediaFolderRepository;
use Mojar\CMS\Http\Controllers\ApiController;
use Mojar\CMS\Repositories\Criterias\FilterCriteria;
use Mojar\CMS\Repositories\Criterias\SearchCriteria;
use Mojar\CMS\Repositories\Criterias\SortCriteria;

class FolderController extends ApiController
{
    public function __construct(protected MediaFolderRepository $folderRepository) {}

    public function index(Request $request): JsonResponse
    {
        $queries = $request->all();
        $this->folderRepository->pushCriteria(new SearchCriteria($queries));
        $this->folderRepository->pushCriteria(new FilterCriteria($queries));
        $this->folderRepository->pushCriteria(new SortCriteria($queries));

        $results = $this->folderRepository->paginate($this->getQueryLimit($request));

        return $this->restPaginate($results);
    }
}
