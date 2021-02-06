<?php

namespace App\Repositories;

use App\Models\Product\Product;
use App\Models\Product\ProductAttribute;
use App\Models\Product\ProductGallery;
use App\Models\Category\Category;
use App\Models\Reference\Tag;
use App\Models\Reference\Attribute;

class ProductRepository
{
    protected $product;
    protected $productAttribute;
    protected $productGallery;
    protected $category;
    protected $tag;
    protected $attribute;

    /**
     * ItemRepository constructor.
     * @param Product          $product
     * @param ProductAttribute $productAttribute
    * @param ProductGallery    $productGallery
     * @param Category         $category
     * @param Tag              $tag
    * @param  Attribute        $attribute
     */
    public function __construct(
        Product          $product,
        ProductGallery   $productGallery,
        ProductAttribute $productAttribute,
        Category         $category,
        Tag              $tag,
        Attribute        $attribute
    )
    {
        $this->product          = $product;
        $this->productAttribute = $productAttribute;
        $this->productGallery = $productGallery;
        $this->category         = $category;
        $this->tag              = $tag;
        $this->attribute        = $attribute;
    }

    /**
     * {@inheritDoc}
     */
    public function all($request)
    {
        if ( $request->input('client') ) {
            return $this->product->select('id', 'name', 'image_url', 'status', 'created_at', 'updated_at')
                ->get();
        }

        $columns = ['id', 'name', 'image_url', 'status', 'updated_at'];

        $length      = $request->input('length');
        $column      = $request->input('column'); //Index
        $dir         = $request->input('dir');
        $searchValue = $request->input('search');

        $query = $this->product->select('id', 'name', 'image_url', 'status', 'created_at', 'updated_at')
            ->orderBy($columns[$column], $dir);

        if ($searchValue) {
            $query->where(function($query) use ($searchValue) {
                $query->where('id',         'like', '%' . $searchValue . '%')
                    ->orWhere('name',       'like', '%' . $searchValue . '%')
                    ->orWhere('status',     'like', '%' . $searchValue . '%')
                    ->orWhere('created_at', 'like', '%' . $searchValue . '%')
                    ->orWhere('updated_at', 'like', '%' . $searchValue . '%');
            });
        }

        $data = $query->paginate($length);
        $columns = array (
            array('width' => '33%', 'label' => 'Id',     'name' => 'id'),
            array('width' => '33%','label' => 'Фото', 'name' => 'image_url', 'type' => 'image'),
            array('width' => '33%', 'label' => 'Наименование',   'name' => 'name'),
               array('width' => '33%', 'label' => 'Статус',   'name' => 'status'),
            array('width' => '33%', 'label' => 'Даты',  'name' => 'dates')
        );

        $statusClass = array (
            array('status' => 'inactive',   'badge' => 'kt-badge--danger'),
            array('status' => 'active', 'badge' => 'kt-badge--success')
        );

        $sortKey = 'id';

        return [
            'data'        => $data,
            'columns'     => $columns,
            'statusClass' => $statusClass,
            'sortKey'     => $sortKey,
            'draw'        => $request->input('draw')
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function create(array $request)
    {
        $sorted = $this->product->orderBy('sort_order', 'DESC')->first();

        if( isset($sorted->id) ) {
            $sortOrder = $sorted->sort_order + 1;
        } else {
            $sortOrder = 1;
        }

        $product = $this->product->create($request['product'] + ['sort_order' => $sortOrder]);
        if(isset($request['product']['categories'])) {
            $product->categories()->sync($request['product']['categories']);
        }

        if( isset($request['photo']) ) {
            $this->savePhoto($request['photo'], $product->id, $imageExist = null);   
        }

        if($request['product']['attributes']) {

            foreach ($request['product']['attributes'] as $attrName) {
                $attr = $this->attribute->where('name', $attrName['name'])->first();
                if( !isset($attr->id) ) {
                  $this->attribute->create(['name' => $attrName['name']]);
                }
            }

            $product->attributes()->createMany($request['product']['attributes']);
        }

        if($request['product']['tags']) {
            $tag = [];
            foreach ($request['product']['tags'] as $tagName) {
                if(is_int($tagName)) {
                    $tag[] = $tagName;
                } else {
                    $t = $this->tag->create(['name' => $tagName]);
                    $tag[] = $t->id;
                }
            }
            $product->tags()->sync($tag);
        }

        return $product;
    }

    /**
     * {@inheritDoc}
     */
    public function find(int $productId)
    {
        $product = $this->product->with(['categories:id,name', 'tags:id,name', 'attributes'])->findOrFail($productId);

        return $product;
    }


    /**
     * {@inheritDoc}
     */
    public function update(array $request, int $productId)
    {
        $this->product->find($productId)->update($request['product']);

        if(isset($request['product']['categories'])) {
            $this->product->find($productId)->categories()->sync($request['product']['categories']);
        }
        
        
        if( isset($request['photo']) ) {
            if( $request['photo'] !== $request['product']['image_url'] ) {
                $this->savePhoto($request['photo'], $productId, $imageExist = null);   
            }
        }

        $attr = $request['product']['attributes'];
        if($attr) {
            foreach ($attr as $item) {

                $a = $this->attribute->where('name', $item['name'])->first();
                if( !isset($a->id) ) {
                  $this->attribute->create(['name' => $item['name']]);
                }

                if(isset($item['id'])) {
                    $this->productAttribute->find($item['id'])->update($item);
                } else {
                    $this->product->find($productId)->attributes()->create($item);
                }
            }
            
        }

        if($request['product']['tags']) {
            $tag = [];
            foreach ($request['product']['tags'] as $tagName) {
                if(is_int($tagName)) {
                    $tag[] = $tagName;
                } else {
                    $t = $this->tag->create(['name' => $tagName]);
                    $tag[] = $t->id;
                }
            }
           $this->product->find($productId)->tags()->sync($tag);
        } else {
           $this->product->find($productId)->tags()->sync([]);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function destroy(int $productId)
    {
        $product = $this->product->find($productId);
        $product->delete();
    }

    public function destroyProductAttribute(int $id)
    {
        $productAttribute = $this->productAttribute->find($id);
        $productAttribute->delete();
    }

    public function savePhoto($logoDataImage, $id, $imageExist) {
        $filename = time().'.' . explode('/', explode(':', substr($logoDataImage, 0, strpos($logoDataImage, ';')))[1])[1];
        $path = 'img/product/' . $id . '/photo/';

        \File::makeDirectory(public_path('img/product/'.$id.'/photo/'), 0755, true, true);
        \Image::make($logoDataImage)->save(public_path('img/product/'.$id.'/photo/').$filename);

        $photo = config('app.url') . '/' . $path.$filename;
        $this->product::find($id)->update(['image_url' => $photo]);
    }


    public function optionsData()
    {
        $tag        = $this->tag->select('id', 'name')->get();
        $attribute  = $this->attribute->select('id', 'name')->get();
        $category   = $this->category->select('id', 'name as label', 'parent_id')->where('parent_id', NULL)->with('children')->where('status', 'active')->get();

        $data = [
            'tags'       => $tag,
            'attributes' => $attribute,
            'categories' => $category
        ];

        return $data;
    }

    public function deleteChecked($request)
    {
        $checkedItems = $request->get('checkedItems');

        foreach ($checkedItems as $item){
            $product = $this->product->find($item);
            $product->delete();

            $this->productAttribute->where('product_id', $item)->delete();
            $this->productGallery->where('product_id', $item)->delete();
        }
    }

    public function copy($request)
    {
        $productId = $request['id'];

        $productCopy = $this->product->with(['categories', 'tags', 'attributes', 'gallery'])->find($productId);

        $sorted = $this->product->orderBy('sort_order', 'DESC')->first();

        if( isset($sorted->id) ) {
            $sortOrder = $sorted->sort_order + 1;
        } else {
            $sortOrder = 1;
        }

        $product = $this->product->create([
            'sort_order' => $sortOrder,
            'name' => $productCopy->name.'-копия',
            'slug' => $productCopy->slug.'-kopiya',
            'article' => $productCopy->article,
            'category_id' => $productCopy->category_id,
            'url' => $productCopy->url,
            'image_url' => $productCopy->image_url,
            'description' => $productCopy->description,
            'price' => $productCopy->price,
            'html_h1' => $productCopy->html_h1,
            'seo_title' => $productCopy->seo_title,
            'seo_description' => $productCopy->seo_description,
            'seo_keywords' => $productCopy->seo_keywords,
            'sticker' => $productCopy->sticker,
            'sticker_position' => $productCopy->sticker_position,
            'sort_order' => $productCopy->sort_order,
            'is_booked' => $productCopy->is_booked, 
            'status' => $productCopy->status
        ]);

        if(isset($productCopy->categories)) {
            $category = [];
            foreach ($productCopy->categories as $item) {
                $category[] = $item['pivot']['category_id'];
            }
            $product->categories()->sync($category);
        }


        if($productCopy->attributes) {
            foreach ($productCopy->attributes as $item) {
                $product->attributes()->create([
                    'product_id' => $item['product_id'],
                    'name' => $item['name'],
                    'description' => $item['description'],
                    'sort_order' => $item['sort_order'],
                ]);
            }
            
        }

        if($productCopy->gallery) {
            foreach ($productCopy->gallery as $item) {
                $product->gallery()->create([
                    'product_id' => $item['product_id'],
                    'name' => $item['name'],
                    'image_url' => $item['image_url'],
                    'sort_order' => $item['sort_order'],
                ]);
            }
        }

        if($productCopy->tags) {
            $tag = [];
            foreach ($productCopy['tags'] as $item) {
                $tag[] = $item['pivot']['tag_id'];
            }
            $product->tags()->sync($tag);
        }

        return $product;
    }

}
