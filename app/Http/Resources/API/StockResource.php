<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class StockResource extends JsonResource
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
            'id'=>$this->purchases_id,
            'product_name'=>$this->product_name,
            'category_name'=>$this->category_name,
            'purchase_price'=>$this->purchase_price,
            'selling_price'=>$this->selling_price,
            'stock_quantity'=>$this->stock_quantity,
            'created_at'=>date('Y-m-d',strtotime($this->created_at)),
        ];
    }
}
