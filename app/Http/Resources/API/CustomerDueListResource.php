<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerDueListResource extends JsonResource
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
            'id'=>$this->sell_id,
            'full_name'=>$this->full_name,
            'phone'=>$this->phone,
            'paid_amount'=>$this->sum_of_total_paid_amount,
            'due_amount'=>$this->sum_of_total_due_amount,
        ];
    }
}
