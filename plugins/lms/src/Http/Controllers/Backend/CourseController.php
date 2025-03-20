<?php

namespace Mojahid\Lms\Http\Controllers\Backend;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Juzaweb\CMS\Http\Controllers\BackendController;
use Mojahid\Lms\Models\Course;
use Illuminate\Support\Str; // Add this import
use Mojahid\Lms\Http\Resources\CourseCurriculumResource;
use Mojahid\Lms\Http\Resources\TopicResource;
use Mojahid\Lms\Http\Resources\CurriculumItemResource;
use Juzaweb\Backend\Models\Post;
use Illuminate\Http\RedirectResponse;

class CourseController extends BackendController
{
    protected function validator(array $attributes, ...$params): \Illuminate\Validation\Validator
    {
        return Validator::make(
            $attributes,
            [
                'title' => 'nullable|string|max:250',
                'slug' => 'nullable|string|max:250',
            ]
        );
    }

    public function ajaxCreate(Request $request, ...$params): JsonResponse|RedirectResponse
    {
        $validator = $this->validator($request->all(), ...$params);
        if (is_array($validator)) {
            $validator = Validator::make($request->all(), $validator);
        }

        $validator->validate();
        $data = $request->all();

        DB::beginTransaction();

        try {
            $model = $this->makeModel(...$params);

            $slug = $request->input('slug') ?? Str::slug($request->input('title'));
            if ($slug && method_exists($model, 'generateSlug')) {
                $data['slug'] = $model->generateSlug($slug);
            }

            $data['type'] = 'courses';
            $data['status'] = 'draft';
            $model->fill($data);

            $model->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        if (method_exists($this, 'storeSuccess')) {
            $this->storeSuccess($request, $model, ...$params);
        }

        if (method_exists($this, 'saveSuccess')) {
            $this->saveSuccess($request, $model, ...$params);
        }

        return response()->json(
            [
                'status' => 'success',
                'data' => $model,
                'message' => 'Course created successfully',
                ]
            );
    }

    public function create(Request $request, ...$params): JsonResponse|RedirectResponse
    {

        $data = [
            'title' => 'Basic Course',
        ];

        DB::beginTransaction();

        try {
            $model = $this->makeModel(...$params);

            $slug = $request->input('slug') ?? Str::slug($request->input('title'));
            if ($slug && method_exists($model, 'generateSlug')) {
                $data['slug'] = $model->generateSlug($slug);
            }

            $data['type'] = 'courses';
            $data['status'] = 'publish';
            $model->fill($data);

            $model->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        if (method_exists($this, 'storeSuccess')) {
            $this->storeSuccess($request, $model, ...$params);
        }

        if (method_exists($this, 'saveSuccess')) {
            $this->saveSuccess($request, $model, ...$params);
        }
        // GET|HEAD        app/post-type/{type}/{id}/edit ........ admin.posts.edit › Backend\PostController@edit 
        // $route = route('admin.posts.edit', ['type' => 'courses', 'id' => $model->id]);
        return redirect()->route('admin.posts.edit', ['type' => 'courses', 'id' => $model->id]);
    }

        /**
     * @param $params
     * @return \Juzaweb\CMS\Models\ResourceModel
     */
    protected function makeModel(...$params)
    {
        return app($this->getModel(...$params));
    }
    
    protected function getModel(...$params): string
    {
        return Post::class;
    }

}