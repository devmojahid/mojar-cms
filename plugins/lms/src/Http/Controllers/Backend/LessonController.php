<?php

namespace Mojahid\Lms\Http\Controllers\Backend;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Juzaweb\CMS\Http\Controllers\BackendController;
use Juzaweb\CMS\Traits\ResourceController;
use Mojahid\Lms\Models\CourseLesson;
use Illuminate\Support\Str;
use Juzaweb\CMS\Traits\ResponseMessage;
use Illuminate\Http\RedirectResponse;
use Mojahid\Lms\Http\Resources\CurriculumItemResource;

class LessonController extends BackendController
{
    use ResponseMessage;
    protected function getDataTable(...$params): LessonDatatable
    {
        return new LessonDatatable();
    }

    protected function validator(array $attributes, ...$params): \Illuminate\Validation\Validator
    {
        return Validator::make(
            $attributes,
            [
                'title' => 'required|string|max:250',
                'slug' => 'nullable|string|max:250',
                'thumbnail' => 'nullable|string',
                'description' => 'nullable|string',
                'status' => 'nullable|string',
                'order' => 'nullable|integer',
                'post_id' => 'nullable|exists:posts,id',
                'course_topic_id' => 'required|exists:lms_course_topics,id',
                'type' => 'nullable|string',
                'duration' => 'nullable|integer',
                'metas' => 'nullable|array',
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

    // show lesson and response json with LessonResource
    public function show(CourseLesson $lesson)
    {
        return response()->json(
            [
                'status' => 'success',
                'data' => new CurriculumItemResource($lesson),
            ]
        );
    }

    public function update(Request $request, CourseLesson $lesson, ...$params): JsonResponse|RedirectResponse
    {
        $validator = $this->validator($request->all(), ...$params);
        if (is_array($validator)) {
            $validator = Validator::make($request->all(), $validator);
        }

        $validator->validate();
        $data = $request->all();

        $model = $lesson;

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
                'data' => new CurriculumItemResource($model),
            ]
        );
    }
    
    
    public function destroy(CourseLesson $lesson, ...$params): JsonResponse|RedirectResponse
    {
        $lesson->delete();

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Lesson deleted successfully',
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
        return CourseLesson::class;
    }

    protected function getTitle(...$params): string
    {
        return trans('lms::content.lessons');
    }
}
