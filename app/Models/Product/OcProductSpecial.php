<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class OcProductSpecial extends Model
{
    protected $table = 'oc_product_special';
    protected $primaryKey = 'product_special_id';

    protected $dateFormat = 'Y-m-d H:i:s';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_special_id',
        'product_id',
        'customer_group_id',
        'priority', 
        'price', 
        'date_start', 
        'date_end', 
    ];

}