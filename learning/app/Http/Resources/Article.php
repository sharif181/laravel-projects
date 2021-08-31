<?php

namespace App\Http\Resources;
use App\Http\Resources\Comment;
use Illuminate\Http\Resources\Json\JsonResource;

class Article extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        return parent::toArray($request);
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'type'=>$this->type,
            'description'=>$this->description,
            'comments'=> Comment::collection($this->comments)
        ];

    }
}
