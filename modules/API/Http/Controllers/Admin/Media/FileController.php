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
use Mojar\Backend\Repositories\MediaFileRepository;
use Mojar\CMS\Http\Controllers\ApiController;
use Mojar\CMS\Repositories\Criterias\FilterCriteria;
use Mojar\CMS\Repositories\Criterias\SearchCriteria;
use Mojar\CMS\Repositories\Criterias\SortCriteria;

class FileController extends ApiController
{
    public function __construct(protected MediaFileRepository $fileRepository) {}

    public function index(Request $request): JsonResponse
    {
        $queries = $request->all();
        $this->fileRepository->pushCriteria(new SearchCriteria($queries));
        $this->fileRepository->pushCriteria(new FilterCriteria($queries));
        $this->fileRepository->pushCriteria(new SortCriteria($queries));

        $results = $this->fileRepository->paginate($this->getQueryLimit($request));

        return $this->restPaginate($results);
    }
}
