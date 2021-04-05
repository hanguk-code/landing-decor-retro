<?php

namespace App\Repositories;

use App\Models\Product\OcProduct;

//use App\Models\Product\ProductAttribute;
use App\Models\Category\OcCategory;

//use App\Models\Reference\Tag;
use App\Models\Attribute\OcAttribute;
use App\Models\OcUrlAlias;
use App\Models\Product\OcProductAttribute;
use App\Models\Product\ProductAttribute;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProductRepository
{
    protected $product;
    protected $productAttribute;
    protected $category;
    //protected $tag;
    protected $attribute;
    protected $urlAlias;

    /**
     * ItemRepository constructor.
     * @param OcProduct $product
     * @param ProductAttribute $productAttribute
     * @param OcCategory $category
     * @param OcAttribute $attribute
     * @param OcUrlAlias $urlAlias
     */
    public function __construct(
        OcProduct $product,
        OcProductAttribute $productAttribute,
        OcCategory $category,
        //Tag              $tag,
        OcAttribute $attribute,
        OcUrlAlias $urlAlias
    )
    {
        $this->product = $product;
        $this->productAttribute = $productAttribute;
        $this->category = $category;
//        $this->tag = $tag;
        $this->attribute = $attribute;
        $this->urlAlias = $urlAlias;
    }

    /**
     * {@inheritDoc}
     */
    public function all($request)
    {
        if ($request->input('client')) {
            return $this->product->all();
        }

        $columns = ['product_id', 'name', 'image', 'status', 'date_modified'];

        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = $this->product->with('description')->orderBy($columns[$column], $dir);

        if ($searchValue) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('product_id', 'like', '%' . $searchValue . '%')
                    //->orWhere('name',       'like', '%' . $searchValue . '%')
                    ->orWhere('status', 'like', '%' . $searchValue . '%')
                    ->orWhere('date_added', 'like', '%' . $searchValue . '%')
                    ->orWhere('date_modified', 'like', '%' . $searchValue . '%');
            });
        }

        $data = $query->paginate($length);

        $dataItem = [];

        foreach ($data as $item) {
            $dataItem[] = [
                'id' => $item->product_id,
                'image' => $item->image,
                'name' => $item->description->name,
                //'status' => $item->status,
                'dates' => $item->dates,
            ];
        }

        $columns = array(
            array('width' => '33%', 'label' => 'Id', 'name' => 'id'),
            array('width' => '33%', 'label' => 'Фото', 'name' => 'image', 'type' => 'image'),
            array('width' => '33%', 'label' => 'Наименование', 'name' => 'name'),
            //array('width' => '33%', 'label' => 'Статус',   'name' => 'status'),
            array('width' => '33%', 'label' => 'Даты', 'name' => 'dates')
        );

        $statusClass = array(
            array('status' => '0', 'badge' => 'kt-badge--danger'),
            array('status' => '1', 'badge' => 'kt-badge--success')
        );

        $sortKey = 'id';

        return [
            'data' => [
                'data' => $dataItem,
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
                'total' => $data->total(),
            ],

            'columns' => $columns,
            'statusClass' => $statusClass,
            'sortKey' => $sortKey,
            'draw' => $request->input('draw')
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function create(array $request)
    {
        $sorted = $this->product->orderBy('sort_order', 'DESC')->first();

        if (isset($sorted->id)) {
            $sortOrder = $sorted->sort_order + 1;
        } else {
            $sortOrder = 1;
        }

        $product = $this->product->create($request['product'] + ['sort_order' => $sortOrder]);
        if (isset($request['product']['categories'])) {
            $product->categories()->sync($request['product']['categories']);
        }

        if (isset($request['photo'])) {
            $this->savePhoto($request['photo'], $product->id, $imageExist = null);
        }

        if ($request['product']['attributes']) {

            foreach ($request['product']['attributes'] as $attrName) {
                $attr = $this->attribute->where('name', $attrName['name'])->first();
                if (!isset($attr->id)) {
                    $this->attribute->create(['name' => $attrName['name']]);
                }
            }

            $product->attributes()->createMany($request['product']['attributes']);
        }

        if ($request['product']['tags']) {
            $tag = [];
            foreach ($request['product']['tags'] as $tagName) {
                if (is_int($tagName)) {
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
//        return $this->product->with(['categories:id,name', 'tags:id,name', 'attributes'])->findOrFail($productId);
        $product = $this->product
            ->with(['categories:product_id,category_id,main_category', 'description', 'attributes', 'gallery'])
            ->leftJoin('oc_url_alias', 'query', DB::raw('\'product_id=' . $productId . '\''))
            ->findOrFail($productId);

        $product->description->description = html_entity_decode($product->description->description);

        foreach ($product->gallery as $key => $image) {
            $product->gallery[$key]['image'] = env('API_WEB_URL') . '/image/' . $product->gallery[$key]['image'];
        }

        return $product;
    }


    /**
     * {@inheritDoc}
     */
    public function update(array $request, int $productId)
    {
        $product = $this->product->find($productId);
        $product->description()->update($request['product']['description']);

        if (isset($request['product']['categories'])) {
            $product->categories()->where(['product_id' => $productId])->delete();
            foreach ($request['product']['categories'] as $item) {
                $product->categories()->updateOrInsert(
                    ['product_id' => $productId, 'category_id' => $item]
                );
            }
            $product->categories()->updateOrInsert(
                ['product_id' => $productId, 'category_id' => $request['product']['main_category_id']],
                ['main_category' => true]
            );
        }

        $attr = $request['product']['attributes'];
        if ($attr) {
            foreach ($attr as $item) {
                $this->productAttribute->updateOrInsert(
                    ['product_id' => $productId, 'attribute_id' => $item['attribute_id'], 'language_id' => 2],
                    ['text' => $item['text']]
                );
            }
        }


        if (isset($request['photo'])) {
            if (strpos($request['photo'], $request['product']['image']) === false) {
                $this->savePhoto($request['photo'], $productId, $imageExist = null);
            }
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

//    public function savePhoto($logoDataImage, $id, $imageExist)
//    {
//        $filename = time() . '.' . explode('/', explode(':', substr($logoDataImage, 0, strpos($logoDataImage, ';')))[1])[1];
//        $path = 'img/product/' . $id . '/photo/';
//
//        \File::makeDirectory(public_path('img/product/' . $id . '/photo/'), 0755, true, true);
//        \Image::make($logoDataImage)->save(public_path('img/product/' . $id . '/photo/') . $filename);
//
//        $photo = config('app.url') . '/' . $path . $filename;
//        $this->product::find($id)->update(['image' => $photo]);
//    }

    public function savePhoto($logoDataImage, $id)
    {
        $filename = time() . '.' . explode('/', explode(':', substr($logoDataImage, 0, strpos($logoDataImage, ';')))[1])[1];
        $path = public_path('image/product/' . $id . '/');

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        $image = $logoDataImage;  // your base64 encoded
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        File::put($path . $filename, base64_decode($image));

        $this->product::find($id)->update(['image' => 'product/' . $id . '/' . $filename]);
    }


    public function optionsData()
    {
//        $tag = $this->tag->select('id', 'name')->get();

        $attributes = $this->attribute->select('attribute_id', 'attribute_id as label')
            ->with('description')
            ->get();

        if (!empty($attributes)) {
            foreach ($attributes as $key => $item) {
                $attribute[] = [
                    'id' => $item->attribute_id,
                    'label' => $item->description->name,
                    'language_id' => $item->description->language_id,
                ];
            }
        }

        $categories = $this->category->select('category_id', 'parent_id', 'category_id as label')
            ->with('description')
            ->with('children')
            ->where('status', true)
            ->where('parent_id', 0)
            ->get();

        foreach ($categories as $category) {
            if (!empty($category->children)) {
                foreach ($category->children as $child) {
                    $children[] = [
                        'id' => $child->category_id,
                        'label' => $child->description->name,
                    ];
                }
            }

            $treeSelect[] = [
                'id' => $category->category_id,
                'label' => $category->description->name,
                'children' => $children ?? []
            ];

            unset($children);
        }

        return [
//            'tags' => $tag,
            'attributes' => $attribute,
            'categories' => $treeSelect ?? []
        ];
    }

    public function deleteChecked($request)
    {
        $checkedItems = $request->get('checkedItems');

        foreach ($checkedItems as $item) {
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

        if (isset($sorted->id)) {
            $sortOrder = $sorted->sort_order + 1;
        } else {
            $sortOrder = 1;
        }

        $product = $this->product->create([
            'sort_order' => $sortOrder,
            'name' => $productCopy->name . '-копия',
            'slug' => $productCopy->slug . '-kopiya',
            'article' => $productCopy->article,
            'category_id' => $productCopy->category_id,
            'url' => $productCopy->url,
            'image' => $productCopy->image,
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

        if (isset($productCopy->categories)) {
            $category = [];
            foreach ($productCopy->categories as $item) {
                $category[] = $item['pivot']['category_id'];
            }
            $product->categories()->sync($category);
        }


        if ($productCopy->attributes) {
            foreach ($productCopy->attributes as $item) {
                $product->attributes()->create([
                    'product_id' => $item['product_id'],
                    'name' => $item['name'],
                    'description' => $item['description'],
                    'sort_order' => $item['sort_order'],
                ]);
            }

        }

        if ($productCopy->gallery) {
            foreach ($productCopy->gallery as $item) {
                $product->gallery()->create([
                    'product_id' => $item['product_id'],
                    'name' => $item['name'],
                    'image' => $item['image'],
                    'sort_order' => $item['sort_order'],
                ]);
            }
        }

        if ($productCopy->tags) {
            $tag = [];
            foreach ($productCopy['tags'] as $item) {
                $tag[] = $item['pivot']['tag_id'];
            }
            $product->tags()->sync($tag);
        }

        return $product;
    }

}
