<?php

namespace App\Models\Category;

use Illuminate\Database\Eloquent\Model;

class OcCategoryDescription extends Model
{
    public $table = 'oc_category_description';

    protected $primaryKey = 'category_id';
    protected $dateFormat = 'Y-m-d H:i:s';
    public $incrementing = false;

    public $timestamps = false;
    
    protected $fillable = [
        'parent_id',
        'language_id', //2
        'name',
        'description',
        'meta_description',
        'meta_keyword',
        'seo_title',
        'seo_h1',
        'custom_title',
        'description1',
    ];
}