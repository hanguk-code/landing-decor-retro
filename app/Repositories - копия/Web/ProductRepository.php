<?php

namespace App\Repositories\Web;

use App\Models\Product\Product;
use App\Models\Product\ProductAttribute;
use App\Models\Category\Category;
use App\Models\Reference\Tag;
use App\Models\Reference\Attribute;

class ProductRepository
{
    protected $product;
    protected $productAttribute;
    protected $category;
    protected $tag;
    protected $attribute;

    /**
     * ItemRepository constructor.
     * @param Product          $product
     * @param ProductAttribute $productAttribute
     * @param Category         $category
     * @param Tag              $tag
     * @param  Attribute        $attribute
     */
    public function __construct(
        Product          $product,
        ProductAttribute $productAttribute,
        Category         $category,
        Tag              $tag,
        Attribute        $attribute
    )
    {
        $this->product          = $product;
        $this->productAttribute = $productAttribute;
        $this->category         = $category;
        $this->tag              = $tag;
        $this->attribute        = $attribute;
    }

    /**
     * {@inheritDoc}
     */
    public function all($request)
    {
       
    }

    public function newAll($request)
    {
        $limit = $request->input('limit') ?? 3;
        $product = $this->product->where('sticker', 'new')->where('status', 'active')->orderBy('sort_order', 'asc')->limit($limit)->get();

        $productData = [];
        foreach ($product as $item) {
            $category = $this->category->find($item['category_id']);

            if($category['parent_id']) {
                $categoryChild = $this->category->find($category['parent_id']);
                $url = $categoryChild['slug'].'/'.$category['slug'].'/'.$item['slug'];
            } else {
                $url = $category['slug'].'/'.$item['slug'];
            }

            $productData[] = [
                'id'        => $item['id'],
                'name'      => $item['name'],
                'image_url' => $item['image_url'],
                'url'       => $url,
                'price'     => $item['price'],
                'article'   => $item['article'],
            ];
        }

        return $productData;
    }

    /**
     * {@inheritDoc}
     */
    public function find(int $productId)
    {
        $product = $this->product->with(['categories:id,name', 'tags:id,name', 'attributes'])->findOrFail($productId);

        return $product;
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

    public function type($url)
    {
        $urlExplode = explode('/',$url);
        $c = count($urlExplode);
        $lastUrl = $urlExplode[$c-1];

        //$product = $this->product->where('status', 'active')->orderBy('sort_order', 'asc')->get();
        $product = $this->product->with(['gallery', 'attributes'])->where('slug', $lastUrl)->first();

        if(isset($product->id)) {
        //foreach ($product as $item) {
            $categoryProd = $this->category->find($product['category_id']);

            if($categoryProd['parent_id']) {
                $categoryChild = $this->category->find($categoryProd['parent_id']);
                $productUrl = $categoryChild['slug'].'/'.$categoryProd['slug'].'/'.$product['slug'];

                 $breadcrumbs = [
                    ['name' => 'Главная', 'url' => '/'],
                    ['name' => $categoryChild['name'], 'url' => '/'.$categoryChild['slug']],
                    ['name' => $categoryProd['name'], 'url' => '/'.$categoryChild['slug'].'/'.$categoryProd['slug']],
                    ['name' => $product['name'], 'url' => '/'.$productUrl]
                ];
            } else {
                $productUrl = $categoryProd['slug'].'/'.$product['slug'];

                 $breadcrumbs = [
                    ['name' => 'Главная', 'url' => '/'],
                    ['name' => $categoryProd['name'], 'url' => '/'.$categoryProd['slug']],
                    ['name' => 'Главная', 'url' => '/'],
                    ['name' => $product['name'], 'url' => '/'.$productUrl]
                ];
            }

            $gallery = [];
            foreach ($product['gallery'] as $itemGallery) {
                $gallery[] = [
                    'name' => $itemGallery['name'],
                    'image_url' => $itemGallery['image_url']
                ];
            }

            $attribute = [];
            foreach ($product['attributes'] as $itemAttr) {
                $attribute[] = [
                    'name'      => $itemAttr['name'],
                    'description' => $itemAttr['description']
                ];
            }

            if($url === $productUrl) {
                $productData = [
                    'id'         => $product['id'],
                    'name'       => $product['name'],
                    'image_url'  => $product['image_url'],
                    'url'        => '/'.$productUrl,
                    'price'      => $product['price'],
                    'article'    => $product['article'],
                    'description'    => $product['description'],
                    'breadcrumbs' => $breadcrumbs,
                    'gallery'    => $gallery,
                    'attributes' => $attribute
                ];

                return [
                    'type' => 'product', 
                    'product' => $productData 
                ];
            }
        //}
        }

        //$category = $this->category->with('children')->where('parent_id', NULL)->where('status', 'active')->orderBy('sort_order', 'asc')->get();

        $category = $this->category->where('slug', $lastUrl)->first();

            if($category['parent_id']) {
                $categoryCatChild = $this->category->find($category['parent_id']);
            }

            if(isset($categoryCatChild->id)) {
                $categoryUrl = $categoryCatChild['slug'].'/'.$category['slug'];
            } else {
                $categoryUrl = $category['slug'];
            }

            if($url === $categoryUrl) {

                $productCat = $this->product->where('category_id', $category->id)->get();

                $productCatData = [];
                foreach ($productCat as $productItemCat) {
                    $productCatData[] = [
                        'id'        => $productItemCat['id'],
                        'name'      => $productItemCat['name'],
                        'image_url' => $productItemCat['image_url'],
                        'url'       => '/'.$categoryUrl.'/'.$productItemCat['slug'],
                        'price'     => $productItemCat['price'],
                        'article'   => $productItemCat['article'],
                    ];
                }

                $subCategoryData = [];
                $subCategory = $this->category->where('parent_id', $category['id'])->where('status', 'active')->orderBy('sort_order', 'asc')->get();

                foreach ($subCategory as $subItem) {
                    $subCategoryData[] = [
                        'id'        => $subItem['id'],
                        'name'      => $subItem['name'],
                        'image_url' => $subItem['image_url'],
                        'url'       => '/'.$category['slug'].'/'.$subItem['slug']
                    ];
                }


                $categoryData = [
                    'id'        => $category['id'],
                    'name'      => $category['name'],
                    'image_url' => $category['image_url'],
                    'url'       => $category['slug']
                ];

                return [
                    'type' => 'category', 
                    'sub_categories' => $subCategoryData,
                    'products' => $productCatData,
                    'category' => $categoryData
                ];
            }
        

    }

}
