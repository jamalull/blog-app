<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
// use Illuminate\Support\Facades\Auth;

class CategoryResource extends JsonResource
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
            'name'        => $this->name,
            'slug'        => $this->slug,
            'keywords'    => $this->keywords,
            'meta_desc'   => $this->meta_desc,
            // 'user_id'     => $this->user_id,
            // 'user_id'     => Auth::user()->id;,
            'created_at'  => $this->created_at->format('d-m-Y')
        ];
    }
}
