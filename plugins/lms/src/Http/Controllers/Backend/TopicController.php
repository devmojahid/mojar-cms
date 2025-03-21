<?php

namespace Mojahid\Lms\Http\Controllers\Backend;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Juzaweb\CMS\Http\Controllers\BackendController;
use Juzaweb\CMS\Traits\ResourceController;
use Mojahid\Lms\Models\CourseTopic;
use Illuminate\Support\Str;
use Juzaweb\CMS\Traits\ResponseMessage;
use Illuminate\Http\RedirectResponse;
use Mojahid\Lms\Http\Resources\TopicResource;
use Illuminate\Database\Eloquent\Model;

class TopicController extends BackendController
{
    use ResponseMessage;
    protected function getDataTable(...$params): TopicDatatable
    {
        return new TopicDatatable();
    }

    protected function validator(array $attributes, ...$params): \Illuminate\Validation\Validator
    {
        return Validator::make(
            $attributes,
            [
                'title' => 'nullable|string|max:250',
                'slug' => 'nullable|string|max:250',
                'description' => 'nullable|string',
                'post_id' => 'required|exists:posts,id',
            ]
        );
    }

    public function store(Request $request, ...$params): JsonResponse|RedirectResponse
    {
        $validator = $this->validator($request->all(), ...$params);
        if (is_array($validator)) {
            $validator = Validator::make($request->all(), $validator);
        }

        $validator->validate();
        // $data = $this->parseDataForSave($request->all(), ...$params);
        $data = $request->all();

        DB::beginTransaction();

        try {
            $model = $this->makeModel(...$params);
            $slug = $request->input('slug') ?? Str::slug($request->input('title'));
            if ($slug && method_exists($model, 'generateSlug')) {
                $data['slug'] = $model->generateSlug($slug);
            }
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
            ]
        );
    }
    // show topic and response json with TopicResource
    public function show(CourseTopic $topic)
    {
        return response()->json(
            [
                'status' => 'success',
                'data' => new TopicResource($topic),
            ]
        );
    }

    // update topic
    public function update(Request $request, CourseTopic $topic, ...$params): JsonResponse|RedirectResponse
    {
        $validator = $this->validator($request->all(), ...$params);
        if (is_array($validator)) {
            $validator = Validator::make($request->all(), $validator);
        }

        $validator->validate();
        // $data = $this->parseDataForSave($request->all(), ...$params);
        $data = $request->all();

        $model = $topic;

        DB::beginTransaction();
        try {
            $slug = $request->input('slug');
            if ($slug && method_exists($model, 'generateSlug')) {
                $data['slug'] = $model->generateSlug($slug);
            }

            $model->fill($data);
            $model->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        if (method_exists($this, 'updateSuccess')) {
            $this->updateSuccess($request, $model, ...$params);
        }

        if (method_exists($this, 'saveSuccess')) {
            $this->saveSuccess($request, $model, ...$params);
        }

        return response()->json(
            [
                'status' => 'success',
                'data' => new TopicResource($model),
            ]
        );
    }

    public function destroy(CourseTopic $topic, ...$params): JsonResponse|RedirectResponse
    {
        $topic->delete();

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Topic deleted successfully',
            ]
        );
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
        return CourseTopic::class;
    }

    protected function getTitle(...$params): string
    {
        return trans('lms::content.topics');
    }
}
