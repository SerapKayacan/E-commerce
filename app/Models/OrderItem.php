<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;




class OrderItem extends Model
{
    use HasFactory,SoftDeletes;
    protected $fiilable = [
        'order_id',
        'product_id',
        'order_quantity',
        'order_price'


    ];
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }



    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
