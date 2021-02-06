<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class OcProductStore extends Model
{
    protected $table = 'oc_product_to_store';
    
    public $incrementing = false;
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'store_id',
    ];

}