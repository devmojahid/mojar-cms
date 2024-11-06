<?php

/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com/cms
 * @license    GNU V2
 */

namespace Mojar\API\Http\Controllers;

use Illuminate\Http\Request;
use Mojar\Backend\Http\Resources\PostCollection;
use Mojar\Backend\Http\Resources\PostResource;
use Mojar\Backend\Repositories\PostRepository;
use Mojar\CMS\Http\Controllers\ApiController;
use Mojar\CMS\Repositories\Criterias\FilterCriteria;
use Mojar\CMS\Repositories\Criterias\SearchCriteria;
use Mojar\CMS\Repositories\Criterias\SortCriteria;

class PostController extends ApiController
{
    public function __construct(protected PostRepository $postRepository) {}

    public function index(Request $request, $type): PostCollection
    {
        $queries = $request->query();
        $queries['type'] = $type;
        $this->postRepository->pushCriteria(new SearchCriteria($queries));
        $this->postRepository->pushCriteria(new FilterCriteria($queries));
        $this->postRepository->pushCriteria(new SortCriteria($queries));

        $limit = $this->getQueryLimit($request);

        $rows = $this->postRepository->frontendListPaginate($limit);

        return new PostCollection($rows);
    }

    public function show($type, $slug): PostResource
    {
        $model = $this->postRepository->createFrontendDetailBuilder()
            ->where('type', '=', $type)
            ->where('slug', '=', $slug)
            ->firstOrFail();

        return new PostResource($model);
    }

    public function related(Request $request, $type, $slug): PostCollection
    {
        $model = $this->postRepository->createFrontendDetailBuilder()
            ->where('type', '=', $type)
            ->where('slug', '=', $slug)
            ->firstOrFail();

        $queries = $request->query();
        $queries['type'] = $type;

        $this->postRepository->pushCriteria(new SearchCriteria($queries));
        $this->postRepository->pushCriteria(new FilterCriteria($queries));
        $this->postRepository->pushCriteria(new SortCriteria($queries));

        $limit = $this->getQueryLimit($request);

        $rows = $this->postRepository->frontendListByTaxonomyPaginate(
            $limit,
            collect($model->json_taxonomies)->pluck('id')->toArray()
        );

        return new PostCollection($rows);
    }
}
