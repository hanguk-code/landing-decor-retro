<?php

namespace App\Repositories\Web;

use App\Models\Category\Category;

class CategoryRepository
{
    protected $category;

    /**
     * CategoryRepository constructor.
     * @param Category $category

     */
    public function __construct(
        Category $category
    )
    {
        $this->category = $category;

    }

    /**
     * {@inheritDoc}
     */
    public function all($request)
    {
        $recordsPerPage = 100;
        $category = $this->category::where('status', 'active')
            ->where('parent_id', NULL)
            ->with('children')
            ->orderBy('sort_order', 'asc')
            ->paginate($recordsPerPage);
        
        $categoryData = [];

        foreach ($category as $item) {
            $categoryChild = [];
            if($item['children']) {
                foreach ($item['children'] as $itemChild) {
                    $categoryChild[] = [
                        'id'        => $itemChild['id'],
                        'name'      => $itemChild['label'],
                        'image_url' => $itemChild['image_url'],
                        'url'       => '/'.$itemChild['slug'].'/'.$item['slug']
                    ];
                }
            }
            
            $categoryData[] = [
                'id'        => $item['id'],
                'name'      => $item['name'],
                'image_url' => $item['image_url'],
                'url'       => '/'.$item['slug'],
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
        $category = $this->category->findOrFail($categoryId);

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
