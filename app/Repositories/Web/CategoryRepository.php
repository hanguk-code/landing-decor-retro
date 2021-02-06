<?php

namespace App\Repositories\Web;

use App\Models\Category\OcCategory;
use App\Models\OcUrlAlias;

class CategoryRepository
{
    protected $category;
    protected $urlAlias;

    /**
     * CategoryRepository constructor.
     * @param OcCategory $category
     * @param OcUrlAlias $urlAlias
     */
    public function __construct(
        OcCategory $category,
        OcUrlAlias $urlAlias
    )
    {
        $this->category = $category;
        $this->urlAlias = $urlAlias;
    }

    /**
     * {@inheritDoc}
     */
    public function all($request)
    {
        $recordsPerPage = 100;
        $category = $this->category::where('status', 1)
            ->where('parent_id', 0)
            ->with('children')
            ->orderBy('sort_order', 'asc')
            ->paginate($recordsPerPage);
        
        $categoryData = [];

        foreach ($category as $item) {
            $categoryChild = [];
            $qu = 'category_id='.$item['category_id'];
            $urlAlias = $this->urlAlias->where('query', $qu)->first();
            if($item['children']) {
                foreach ($item['children'] as $itemChild) {
                    $quChild = 'category_id='.$itemChild['category_id'];
                    $urlAliasChild = $this->urlAlias->where('query', $quChild)->first();
                    $categoryChild[] = [
                        'id'        => $itemChild['category_id'],
                        'name'      => $itemChild['description']['name'],
                        'image_url' => $itemChild['image'],
                        'url'       => '/'.$urlAlias['keyword'].'/'.$urlAliasChild['keyword']
                    ];
                }
            }
            
            $categoryData[] = [
                'id'        => $item['category_id'],
                'name'      => $item['description']['name'],
                'image_url' => $item['image'],
                'url'       => '/'.$urlAlias['keyword'],
                'children'  => $categoryChild
            ];
        }

        $response = [
            'pagination' => [
                'total' => $category->total(),
                'per_page' => $category->perPage(),
                'current_page' => $category->currentPage(),
                'last_page' => $category->lastPage(),
                'from' => $category->firstItem(),
                'to' => $category->lastItem()
            ],
            'data' => $categoryData
        ];
        

        return $response;
    }

    /**
     * {@inheritDoc}
     */
    public function find(int $categoryId)
    {
        $category = $this->category->with('description')->findOrFail($categoryId);

        return $category;
    }

    public function optionsData($request)
    {
        $currentCatId = $request->input('id');

        $category = $this->category->select('id', 'name as label', 'parent_id')->with('children')->where('status', 'active');

        if(isset($currentCatId)) {
            $category = $category->where('id', '!=', $currentCatId);
        }

        $category = $category->get();
        $category   = $category->push(['id' => 0, 'label' => 'Главная категория', 'parent_id' => null, 'children' => [], 'dates' => "<br><br>"]);

        $data = [
            'categories' => $category,
        ];

        return $data;
    }

}
