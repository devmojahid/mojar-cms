<?php

namespace Mojahid\Lms\Http\Controllers\Backend;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Juzaweb\CMS\Http\Controllers\BackendController;
use Juzaweb\CMS\Traits\ResourceController;
use Mojahid\Lms\Models\Course;

class CurriculumController extends BackendController
{
    public function index(Course $course)
    {
        $course->load([
            'topics',
            'lessons',
            'quizzes',
            'assignments'
        ]);

        return new CourseCurriculumResource($course);
    }

}