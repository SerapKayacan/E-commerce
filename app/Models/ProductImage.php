<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\Category;


class ProductImage extends Model
{

    use HasFactory,SoftDeletes;

    protected $table = 'product_images';



    protected $fillable = [
        'image_name',
        'product_id',

    ];

}
