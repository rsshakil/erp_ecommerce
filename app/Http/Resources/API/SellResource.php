<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class SellResource extends JsonResource
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
            'invoice_no'=>$this->invoice_no,
            'total_quantity'=>$this->total_quantity,
            'total_amount'=>$this->total_amount,
            'total_paid_amount'=>$this->total_paid_amount,
            'total_due_amount'=>$this->total_due_amount,
            'total_discount_amount'=>$this->total_discount_amount,
            'created_at'=>date('Y-m-d',strtotime($this->created_at)),
        ];
    }
}
