<?php

namespace App\Models\Category;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Product\Product;

class Category extends Model
{
    use SoftDeletes;
    
    public $table = 'category';

    protected $dateFormat = 'Y-m-d H:i:s';

    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'url',
        'image_url',
        'sort_order',
        'status',

        'seo_title',
        'seo_description',
        'seo_keywords',

        'created_at',
        'updated_at',
        'deleted_at'
    ];

     protected $appends = ['dates'];

    public function getDatesAttribute()
    {
        return 'Р: '.$this->updated_at."<br>".'С: '.$this->created_at;
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id')->selectRaw('id, name as label, image_url, slug, parent_id')->where('status', 'active');
    }

    public function child()
    {
        return $this->hasMany(Category::class, 'parent_id')->selectRaw('id, name as label, image_url, slug, parent_id')->where('status', 'active');
    }

    //recursive child call
    public function children()
    {
        return $this->child()->with('children')->where('status', 'active');
    }
}