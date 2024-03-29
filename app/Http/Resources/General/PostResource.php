<?php

namespace App\Http\Resources\General;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "title"=> $this->title,
            "slug"=> $this->slug,
            "url"=> route('frontend.posts.show', $this->slug),
            "description"=> $this->description,
            "status"=> $this->status(),
            "comment_able"=> $this->comment_able,
            "created_date"=> $this->created_at->format('Y-m-d h:i a'),
            "author"=> new UsersResource($this->user),
            "category"=> new CategoriesResource($this->category),
            "tags"=> TagsResource::collection($this->tags),
            "media"=> PostsMediaResource::collection($this->media),
            "comments_count"=> $this->comments->where('status', 1)->count(),
            "comments"=> PostCommentsResource::collection($this->approved_comments),
            
        ];
    }
}
