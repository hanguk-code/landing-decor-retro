<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

use App\Models\Attribute\OcAttributeDescription;

class OcProductAttribute extends Model
{
    protected $table = 'oc_product_attribute';
    
    public $incrementing = false;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'attribute_id',
        'language_id',
        'text', 
    ];

    public function description()
    {
        return $this->hasOne(OcAttributeDescription::class, 'attribute_id', 'attribute_id');
    }

}