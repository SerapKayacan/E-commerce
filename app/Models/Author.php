<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Author extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [

        'author_type',
        'author_name'
    ];
    public function products()
    {
        return $this->hasMany(Product::class,'author_id');
    }

}

