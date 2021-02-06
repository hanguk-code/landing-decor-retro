<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class OcProductDescription extends Model
{
    protected $table = 'oc_product_description';

    protected $dateFormat = 'Y-m-d H:i:s';
    
    public $incrementing = false;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'language_id',
        'name',
        'description', 
        'meta_description', 
        'meta_keyword', 
        'seo_title', 
        'seo_h1', 
        'tag', 
        'custom_title', 
    ];

}