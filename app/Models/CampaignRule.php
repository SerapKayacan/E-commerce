<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CampaignRule extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'campaign_id',
        'author_id',
        'campaign_type',
        'author_type',
        'category_id',
        'discount_type',
        'discount_value',
        'min_total_price',
        'campaign_rules_status',

    ];
    public function campaign()
    {
        return $this->belongsTo(Campaign::class,'campaign_id');
    }
    public function author()
    {
        return $this->belongsTo(Author::class,'author_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

}
