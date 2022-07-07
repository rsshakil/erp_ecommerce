<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class BlancePayResource extends JsonResource
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
            'id'=>$this->amount_payments_id,
            'full_name'=>$this->full_name,
            'phone'=>$this->phone,
            'amount'=>$this->amount,
            'bank_name'=>$this->bank_name,
            'checque_no'=>$this->checque_no,
            'type'=>$this->type==1?'Receive':'Payment',
        ];
    }
}
