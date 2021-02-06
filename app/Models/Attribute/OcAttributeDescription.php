<?php

namespace App\Models\Attribute;

use Illuminate\Database\Eloquent\Model;

class OcAttributeDescription extends Model
{
    protected $table = 'oc_attribute_description';

    protected $dateFormat = 'Y-m-d H:i:s';
    
    public $incrementing = false;
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'attribute_id',
        'language_id',
        'name',
    ];

}