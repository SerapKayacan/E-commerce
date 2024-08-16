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
        'cargo_price',
        'total_price',
        'date_of_delivery',
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
}
