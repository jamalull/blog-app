<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'cover'        => $this->cover,
            'title'        => $this->title,
            'slug'        => $this->slug,
            'desc'        => $this->desc,
            'keywords'    => $this->keywords,
            'meta_desc'   => $this->meta_desc,
            'created_at'  => $this->created_at->format('d-m-Y')
        ];
    }
}
