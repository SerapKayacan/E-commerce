<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\Category;

class Product extends Model
{

    use HasFactory, SoftDeletes;
    // Tablo ismi (opsiyonel, eğer tablonuzun ismi categories ise bu satıra gerek yok)
    protected $table = 'products';


    // Doldurulabilir alanlar
    protected $fillable = [
        'product_name',
        'author_id',
        'product_category_id',
        'barcode',
        'product_status',
        'stock_quantity',
        'price',
        'product_slug',
        'product_image',



    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'product_category_id');
    }



    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'product_id');
    }
    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }

}
