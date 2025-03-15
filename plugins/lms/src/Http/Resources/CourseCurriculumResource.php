<?php
namespace Mojahid\Lms\Http\Resources;

use Illuminate\Http\Request;
use Juzaweb\Backend\Http\Resources\PostResource;

/**
 * @property-read Course $resource
 */
class CourseCurriculumResource extends PostResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        // Get topics from the course
        $topics = TopicResource::collection($this->topics)->resolve();
        
        // Create a flat array for all curriculum items
        $items = [];
        
        // Eager load the topics with their lessons
        $this->load('topics.lessons');
        
        // In the future, add these when implemented:
        // $this->load('topics.quizzes');
        // $this->load('topics.assessments');
        
        foreach ($this->topics as $topic) {
            // Handle lessons
            foreach ($topic->lessons as $lesson) {
                $items[] = [
                    'id' => $lesson->id,
                    'type' => 'lesson',
                    'title' => $lesson->title,
                    'order' => $lesson->order ?? 0,
                    'topic_id' => $lesson->course_topic_id,
                    'created_at' => $lesson->created_at,
                    'updated_at' => $lesson->updated_at,
                    'content' => $lesson->metas['content'] ?? null,
                    'duration' => $lesson->duration ?? 0,
                    // Other lesson-specific fields
                ];
            }
            
            // Handle quizzes when implemented
            // foreach ($topic->quizzes as $quiz) {
            //     $items[] = [
            //         'id' => $quiz->id,
            //         'type' => 'quiz',
            //         'title' => $quiz->title,
            //         'order' => $quiz->order ?? 0,
            //         'topic_id' => $quiz->course_topic_id,
            //         'created_at' => $quiz->created_at,
            //         'updated_at' => $quiz->updated_at,
            //         'questions' => $quiz->questions ?? [],
            //         // Other quiz-specific fields
            //     ];
            // }
            
            // Handle assessments when implemented
            // foreach ($topic->assessments as $assessment) {
            //     $items[] = [
            //         'id' => $assessment->id,
            //         'type' => 'assessment',
            //         'title' => $assessment->title,
            //         'order' => $assessment->order ?? 0,
            //         'topic_id' => $assessment->course_topic_id,
            //         'created_at' => $assessment->created_at,
            //         'updated_at' => $assessment->updated_at,
            //         'deadline' => $assessment->deadline,
            //         // Other assessment-specific fields
            //     ];
            // }
        }
        
        // Sort all items by topic_id and then by order
        usort($items, function($a, $b) {
            // First sort by topic_id
            if ($a['topic_id'] !== $b['topic_id']) {
                return $a['topic_id'] <=> $b['topic_id'];
            }
            // Then sort by order within the same topic
            return $a['order'] <=> $b['order'];
        });
        
        return [
           'topics' => $topics,
           'items' => $items
        ];
    }
}