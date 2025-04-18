<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

use Mojahid\Lms\Http\Controllers\Backend\{
    CustomerController,
    SettingController,
    CurriculumController,
    TopicController,
    LessonController,
    CourseController,
    OrderController
};

use Illuminate\Support\Facades\Route;

Route::jwResource(
    'lms/customers',
    CustomerController::class,
    [
        'name' => 'customers'
    ]
);

Route::get('lms/settings', [SettingController::class, 'index'])->name('admin.lms.setting');
Route::post('lms/settings', [SettingController::class, 'save'])->name('admin.lms.setting.save');

Route::get('/courses/{course}/curriculum', [CurriculumController::class, 'index'])
     ->name('courses.curriculum.index');


Route::apiResource('lms/topics', TopicController::class);
Route::apiResource('lms/lessons', LessonController::class);

Route::post('/post-type/courses/ajax-create', [CourseController::class, 'ajaxCreate'])->name('courses.ajax-create');


Route::get('post-type/courses/create', [CourseController::class, 'create'])->name('admin.post-type.courses.create');
