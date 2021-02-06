<?php

namespace App\Models\Attribute;

use Illuminate\Database\Eloquent\Model;

class OcAttribute extends Model
{
    protected $table = 'oc_attribute';
    
    protected $primaryKey = 'attribute_id';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'attribute_id',
        'attribute_group_id',
        'sort_order',
        'attributes', 
    ];

    public function description()
    {
        return $this->hasOne(OcAttributeDescription::class, 'attribute_id', 'attribute_id');
    }

}