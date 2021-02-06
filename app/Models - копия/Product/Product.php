<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\User\User;
use App\Models\Category\Category;
use App\Models\Reference\Attribute;
use App\Models\Reference\Tag;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'product';

    protected $dateFormat = 'Y-m-d H:i:s';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'article',
        'category_id',
        'url',
        'image_url',
        'description',
        'price',

        'html_h1',
        'seo_title',
        'seo_description',
        'seo_keywords',

        'sticker',
        'sticker_position',

        'sort_order',
        'is_booked',
        'status',

        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $casts = [
        "is_booked" => "boolean",
    ];
    
    protected $appends = ['dates'];

    public function getDatesAttribute()
    {
        return 'Р: '.$this->updated_at."<br>".'С: '.$this->created_at;
    }

    public function gallery()
    {
        return $this->hasMany(ProductGallery::class)->orderBy('sort_order');
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class)->orderBy('sort_order');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_category', 'product_id', 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tag', 'product_id', 'tag_id');
    }
}