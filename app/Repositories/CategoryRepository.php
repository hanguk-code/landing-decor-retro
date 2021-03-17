<?php

namespace App\Repositories;

use App\Models\Category\OcCategory;
use App\Models\Category\OcCategoryDescription;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CategoryRepository
{
    protected $category;

    /**
     * CategoryRepository constructor.
     * @param OcCategory $category
     */
    public function __construct(
        OcCategory $category
    )
    {
        $this->category = $category;

    }

    /**
     * {@inheritDoc}
     */
    public function all($request)
    {
        if ($request->input('client')) {
            return $this->category->all();
        }

        $columns = ['category_id', 'name', 'image', 'status', 'date_modified'];

        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = $this->category->with('description')->orderBy($columns[$column], $dir);

        if ($searchValue) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('category_id', 'like', '%' . $searchValue . '%')
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
                'id' => $item->category_id,
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
        $sorted = $this->category->orderBy('sort_order', 'DESC')->first();

        if (isset($sorted->id)) {
            $sortOrder = $sorted->sort_order + 1;
        } else {
            $sortOrder = 1;
        }

        $category = $this->category->create($request['category'] + ['sort_order' => $sortOrder]);

        if (isset($request['photo'])) {
            $this->savePhoto($request['photo'], $category->id);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function find(int $categoryId)
    {
        return $this->category->with('description')->where('category_id', $categoryId)->first();
    }


    /**
     * {@inheritDoc}
     */
    public function update($request, int $categoryId)
    {
        if (isset($request['photo'])) {
            if (strpos($request['photo'], $request['category']['image']) === false) {
                $request['category']['image'] = $this->savePhoto($request['photo'], $categoryId);
            }
        }

        $this->category->find($categoryId)->update($request['category']);
        OcCategoryDescription::find($categoryId)->update($request['category']['description']);
    }

    public function savePhoto($logoDataImage, $id): string
    {
        $filename = time() . '.' . explode('/', explode(':', substr($logoDataImage, 0, strpos($logoDataImage, ';')))[1])[1];
        $path = public_path('image/category/' . $id . '/');

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        $image = $logoDataImage;  // your base64 encoded
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        File::put($path . $filename, base64_decode($image));

        return 'category/' . $id . '/' . $filename;
    }

    /**
     * {@inheritDoc}
     */
    public function destroy(int $categoryId)
    {
        $category = $this->category->find($categoryId);
        $category->delete();
    }

    /**
     * getting the categories' tree for treeselect
     * @param $request
     * @return array
     */
    public function optionsData($request)
    {
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

        return $treeSelect ?? [];
    }

    public function deleteChecked($request)
    {
        $checkedItems = $request->get('checkedItems');

        foreach ($checkedItems as $item) {
            $product = $this->category->find($item);
            $product->delete();
        }
    }

}
