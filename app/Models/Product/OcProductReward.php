<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class OcProductReward extends Model
{
    protected $table = 'oc_product_reward';
    protected $primaryKey = 'product_reward_id';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_reward_id',
        'product_id',
        'customer_group_id',
        'points', 
    ];

}