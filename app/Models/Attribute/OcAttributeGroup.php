<?php

namespace App\Models\Attribute;

use Illuminate\Database\Eloquent\Model;

class OcAttributeGroup extends Model
{
    protected $table = 'oc_attribute_group';
    protected $primaryKey = 'attribute_group_id';

    protected $dateFormat = 'Y-m-d H:i:s';
    
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'attribute_group_id',
        'sort_order',
    ];

}