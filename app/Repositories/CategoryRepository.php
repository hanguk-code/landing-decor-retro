<?php

namespace App\Repositories;

use App\Models\Category\OcCategory;

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
        if ( $request->input('client') ) {
            return $this->category->all();
        }

        $columns = ['category_id', 'name', 'image', 'status', 'date_modified'];

        $length      = $request->input('length');
        $column      = $request->input('column'); //Index
        $dir         = $request->input('dir');
        $searchValue = $request->input('search');

        $query = $this->category->with('description')->orderBy($columns[$column], $dir);

        if ($searchValue) {
            $query->where(function($query) use ($searchValue) {
                $query->where('category_id',         'like', '%' . $searchValue . '%')
                    //->orWhere('name',       'like', '%' . $searchValue . '%')
                    ->orWhere('status',       'like', '%' . $searchValue . '%')
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

        $columns = array (
            array('width' => '33%', 'label' => 'Id',     'name' => 'id'),
            array('width' => '33%','label' => 'Фото', 'name' => 'image', 'type' => 'image'),
            array('width' => '33%', 'label' => 'Наименование',   'name' => 'name'),
               //array('width' => '33%', 'label' => 'Статус',   'name' => 'status'),
            array('width' => '33%', 'label' => 'Даты',  'name' => 'dates')
        );

        $statusClass = array (
            array('status' => '0',   'badge' => 'kt-badge--danger'),
            array('status' => '1', 'badge' => 'kt-badge--success')
        );

        $sortKey = 'id';

         return [
            'data' => [
                'data' => $dataItem,
                'current_page' => $data->currentPage(),
                'last_page'    => $data->lastPage(),
                'total'    => $data->total(),
            ],
            
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
        $sorted = $this->category->orderBy('sort_order', 'DESC')->first();

        if( isset($sorted->id) ) {
            $sortOrder = $sorted->sort_order + 1;
        } else {
            $sortOrder = 1;
        }

        $category = $this->category->create($request['category'] + ['sort_order' => $sortOrder]);

        if( isset($request['photo']) ) {
            $this->savePhoto($request['photo'], $category->id, $imageExist = null);   
        }
    }

    /**
     * {@inheritDoc}
     */
    public function find(int $categoryId)
    {
        $category = $this->category->with('description')->where('category_id', $categoryId)->first();

        return $category;
    }


    /**
     * {@inheritDoc}
     */
    public function update(array $request, int $categoryId)
    {
        $category = $this->category->find($categoryId)->update($request['category']);

        if( isset($request['photo']) ) {
            if($request['photo'] !== $request['category']['image_url']) {
                $this->savePhoto($request['photo'], $categoryId, $imageExist = null); 
            }
        }
    }

    public function savePhoto($logoDataImage, $id, $imageExist) {
        $filename = time().'.' . explode('/', explode(':', substr($logoDataImage, 0, strpos($logoDataImage, ';')))[1])[1];
        $path = 'img/category/' . $id . '/photo/';

        // if(isset($imageExist)){
        //     $explodedLogo = explode('/', $imageExist);
        //     $logoName = end($explodedLogo);
        //     $imageToRemove = public_path($path.$logoName); // get previous image from folder
        //     if (\File::exists($imageToRemove)) { // unlink or remove previous image from folder
        //         unlink($imageToRemove);
        //     }
        // }
        
        \File::makeDirectory(public_path('img/category/'.$id.'/photo/'), 0755, true, true);
        \Image::make($logoDataImage)->save(public_path('img/category/'.$id.'/photo/').$filename);

        $photo = config('app.url') . '/' . $path.$filename;
        $this->category::find($id)->update(['image_url' => $photo]);
    }

    /**
     * {@inheritDoc}
     */
    public function destroy(int $categoryId)
    {
        $category = $this->category->find($categoryId);
        $category->delete();
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

    public function deleteChecked($request)
    {
        $checkedItems = $request->get('checkedItems');

        foreach ($checkedItems as $item){
            $product = $this->category->find($item);
            $product->delete();
        }
    }

}
