<?php

namespace App\Models\Attribute;

use Illuminate\Database\Eloquent\Model;

class OcAttributeGroupDescription extends Model
{
    protected $table = 'oc_attribute_group_description';

    protected $dateFormat = 'Y-m-d H:i:s';
    
    public $incrementing = false;
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'attribute_group_id',
        'language_id',
        'name',
    ];

}