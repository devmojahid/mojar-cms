<?php

namespace Mojahid\Lms\Http\Controllers\Backend;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Juzaweb\CMS\Http\Controllers\BackendController;
use Mojahid\Lms\Models\Course;
use Mojahid\Lms\Http\Resources\CourseCurriculumResource;
use Mojahid\Lms\Http\Resources\TopicResource;
use Mojahid\Lms\Http\Resources\CurriculumItemResource;

class CurriculumController extends BackendController
{
    public function index(Course $course)
    {
        // Log the course ID for debugging
        \Log::info('Loading curriculum for course ID: ' . $course->id);
        
        // The eager loading is now handled in the resource
        // so we just need to pass the course model
        
        // Return the resource
        return new CourseCurriculumResource($course);
    }

}