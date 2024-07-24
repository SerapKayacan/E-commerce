<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Category extends Model
{
    use HasFactory;
     // Tablo ismi (opsiyonel, eğer tablonuzun ismi categories ise bu satıra gerek yok)
     protected $table = 'categories';

     // Doldurulabilir alanlar
     protected $fillable = [
         'category_name',
         'category_description',
         'category_status'
     ];

     // Eager loading yaparken kullanacağınız ilişkileri burada tanımlayabilirsiniz
     // Örneğin, bir kategori birden fazla ürüne sahip olabilir
     public function products()
     {
         return $this->hasMany(Product::class, 'product_category_id');
     }


}
