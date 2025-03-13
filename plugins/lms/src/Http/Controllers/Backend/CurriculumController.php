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
        
        // Load the topics and lessons
        $course->load([
            'topics',
            'lessons',
            // 'quizzes',
            // 'assignments'
        ]);
        
        // Log the number of topics and lessons for debugging
        \Log::info('Loaded ' . $course->topics->count() . ' topics');
        \Log::info('Loaded ' . $course->lessons->count() . ' lessons');
        
        // Return the resource
        return new CourseCurriculumResource($course);
    }

}