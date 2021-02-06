<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{

    protected $table = 'attribute';

    protected $dateFormat = 'Y-m-d H:i:s';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',

        'created_at',
        'updated_at'
    ];
}