<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResouce extends JsonResource
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
            'id'=>$this->cat_id,
            'cat_name'=>$this->cat_name,
            'sub_cat_name'=>$this->sub_cat_name,
            'created_at'=>date('Y-m-d',strtotime($this->created_at)),
        ];
    }
}
