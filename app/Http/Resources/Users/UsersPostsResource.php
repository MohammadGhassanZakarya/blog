<?php

namespace App\Http\Resources\Users;

use App\Http\Resources\General\CategoriesResource;
use App\Http\Resources\General\PostsMediaResource;
use App\Http\Resources\General\TagsResource;
use App\Http\Resources\General\UsersResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UsersPostsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id"=> $this->id,
            "title"=> $this->title,
            "slug"=> $this->slug,
            "status"=> $this->status,
            "status_text"=> $this->status(),
            "comment_able"=> $this->comment_able,
            "created_date"=> $this->created_at->format('Y-m-d h:i a'),
            "comments_count"=> $this->comments->where('status', 1)->count(),
        ];
    }
}
