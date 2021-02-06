<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OcUrlAlias extends Model
{
    
    public $table = 'oc_url_alias';

    protected $primaryKey = 'url_alias_id';
    protected $dateFormat = 'Y-m-d H:i:s';

    public $timestamps = false;

    protected $fillable = [
        'url_alias_id',
        'query',
        'keyword',
        'language_id',
    ];

   
}