<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;
use App\category;

class CostResouce extends JsonResource
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
            'id'=>$this->cost_id,
            'cost_name'=>$this->cost_name,
            'category_id'=>$this->category_id,
            'cat_name'=>category::where('cat_id',$this->category_id)->value('cat_name'),
            'sub_cost_name'=>$this->sub_cost_name,
            'cost_amount'=>$this->cost_amount,
            'created_at'=>date('Y-m-d',strtotime($this->created_at)),
        ];
    }
}
