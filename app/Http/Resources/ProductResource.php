<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'product_name' => $this->product_name,
            'author_id' => $this->author_id,
            'product_category_id' =>  $this->product_category_id,
            'barcode' =>  $this->barcode,
            'product_status' => $this->product_status,
            'stock_quantity' =>  $this->stock_quantity,
            'price' =>  $this->price,
            'product_slug'=> $this->product_slug,
            'product_image'=> $this->product_image,
            'product_id'=> $this->id,
            'category_name'=>$this->category?->category_name

            // 'category_name' =>  $this->pricecategory->category_name,
        ];
    }
}
