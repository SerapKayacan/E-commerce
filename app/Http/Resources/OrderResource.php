<?php

namespace App\Http\Resources;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'order_status' => $this->order_status,
            'id'=>$this->id,
            'user_id' => $this->user->id,
            'campaign_id' => $this->campaign_id,
            'cargo_price' => $this->cargo_price,
            'total_price' => $this->total_price,
            'discount_price' => $this->discount_price
        ];
    }
}
