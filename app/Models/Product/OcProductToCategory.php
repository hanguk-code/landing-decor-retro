<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product\OcProduct;

class OcProductToCategory extends Model
{
    protected $table = 'oc_product_to_category';

    public $incrementing = false;
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'category_id',
        'main_category',
    ];

    public function productsCategoryData() {
        return $this->hasOne(OcProduct::class, 'product_id', 'product_id');
    }

}