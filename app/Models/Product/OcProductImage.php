<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class OcProductImage extends Model
{
    protected $table = 'oc_product_image';
    protected $primaryKey = 'product_image_id';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_image_id',
        'product_id',
        'image',
        'sort_order',
    ];

}