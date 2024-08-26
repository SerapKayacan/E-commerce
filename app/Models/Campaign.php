<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Campaign extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'campaign_name',
        'campaign_status',
    ];

    public function campaign_rules()
    {
        return $this->hasMany(CampaignRule::class,'campaign_id');
    }


    public function orders()
    {
        return $this->hasMany(Order::class,'campaign_id');
    }

}
