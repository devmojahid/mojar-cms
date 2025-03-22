<?php
// phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'lms_course_lessons',
            function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('slug')->unique();
                $table->text('thumbnail')->nullable();
                $table->text('description')->nullable();
                $table->string('status')->default('publish');
                $table->integer('order')->default(0);
                $table->string('type')->default('video');
                $table->integer('duration')->default(0);
                $table->json('metas')->nullable();
                $table->string('content_url')->nullable();
                $table->string('local_video_path')->nullable();
                $table->unsignedBigInteger('post_id')->nullable(); // this is course id
                $table->unsignedBigInteger('course_topic_id')->index();
                $table->timestamps();

                $table->foreign('post_id')
                    ->references('id')
                    ->on('posts')
                    ->onDelete('cascade')
                    ->nullable();

                $table->foreign('course_topic_id')
                    ->references('id')
                    ->on('lms_course_topics')
                    ->onDelete('cascade');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lms_course_lessons');
    }
};
