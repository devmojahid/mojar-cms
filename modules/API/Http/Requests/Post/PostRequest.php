<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

namespace Juzaweb\API\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Juzaweb\Backend\Models\Post;
use Juzaweb\Backend\Repositories\PostRepository;

class PostRequest extends FormRequest
{
    public function rules(): array
    {
        $statuses = app(PostRepository::class)->getStatuses(
            $this->route()->parameter('type')
        );

        return [
            'title' => 'bail|required|string|max:250',
            'content' => 'bail|nullable|string',
            'slug' => [
                'bail',
                'nullable',
                'string',
                Rule::modelUnique(Post::class, 'slug')
            ],
            'status' => [
                'bail',
                'nullable',
                'string',
                Rule::in($statuses)
            ]
        ];
    }
}
