<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'order_status',
        'user_id',
        'campaign_id',
        'cargo_price',
        'total_price',
        'discount_price'

    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function order_items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }


    public function campaigns()
    {
        return $this->belongsTo(Campaign::class,'campaign_id');
    }
}
