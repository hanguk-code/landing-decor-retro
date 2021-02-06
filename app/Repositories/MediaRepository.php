<?php

namespace App\Repositories;

use App\Models\Product\ProductGallery;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use ImageOptimizer;
use Carbon\Carbon;

class MediaRepository
{
    protected $productGallery;

    /**
     * MediaRepository constructor.
     * @param ProductGallery $productGallery
     */
    public function __construct(
        ProductGallery $productGallery
    )
    {
        $this->productGallery = $productGallery;
    }

    
    public function all($request)
    {
        $itemType = $request->input('item_type');

        if($itemType == 'product') {
             $model      = new $this->productGallery;
             $itemColumn = 'product_id';
        }

        $id = null;
        $pID = $request['item_id'];
        

        if (!is_null($id)) {
            $response = $model::findOrFail($id);
        } else {
            $files = $model::where($itemColumn, $pID)
            ->orderBy('sort_order', 'asc')->paginate(6); //->paginate($recordsPerPage);
            
            $response = [
                'pagination' => [
                    'total' => $files->total(),
                    'per_page' => $files->perPage(),
                    'current_page' => $files->currentPage(),
                    'last_page' => $files->lastPage(),
                    'from' => $files->firstItem(),
                    'to' => $files->lastItem()
                ],
                'data' => $files
            ];
        }

        return $response;
    }

    
    public function create($request)
    {
        $itemType = $request['media_data']['item_type'];
        $mediaData = $request['media_data'];

        if($itemType == 'product') {
             $model = new $this->productGallery;
             $sorted = $this->productGallery->where('product_id', $mediaData['item_id'])->orderBy('id', 'DESC')->first();
              $input['product_id'] = $mediaData['item_id'];
        }

        $input['image_url'] = $mediaData['path'];
        $input['name'] = $mediaData['name'];
        if( isset($sorted->sort_order) ) {
            $input['sort_order'] = $sorted->sort_order + 1;
        } else {
            $input['sort_order'] = 1;
        }
         $model->create($input);
    }

    
    public function destroy(int $id, $request)
    {
        $itemType = $request->input('item_type');

        if($itemType == 'product') {
            $this->productGallery->find($id)->delete();
        }
    }

    
    public function sort($request)
    {
        $itemType = $request->input('item_type');

        $position = $request['files'];
        $i=1;
        foreach($position as $pos){
            if($itemType == 'product') {
                $productMedia = $this->productGallery->find($pos['id']);
            }
            
            $productMedia->sort_order = $i;
            $productMedia->save();

            $i++;
        }

    }

    public function storeMedia($request)
    {
        $file = $request->file('file');
        $estId = $request->get('id');
        $folder = $request->get('item_type');
        $filename = $file->getClientOriginalName();

        $productMedia = new $this->productGallery; //for image types

        $originalExt = $file->getClientOriginalExtension();
        $type = $productMedia->getType($originalExt);

        $getExt = preg_replace('/^.*\.([^.]+)$/D', '$1', $filename);
        $filenameWithoutExtension = explode($getExt, $filename);
        $nativeFileName = mb_substr($filenameWithoutExtension[0], 0, -1);

        $path = $folder . '/' . $estId . '/' . $type;

        //\File::makeDirectory(public_path('m/product/'.$estId.'/'.$type.'/'), 0755, true, true);

        if(Storage::disk('media')->put($path.'/'.$filename,  File::get($file))) {

            $fullPath = \Config::get('app.url').'/m/'.$path.'/'.$nativeFileName.'.'.$originalExt;

            $data = ['media_data' => [
                'path' => $fullPath,
                'name' => $nativeFileName,
                'type' => $type,
                'item_type' => $folder,
                'extension' => $originalExt,
                'item_id' => $estId
            ]];

            return $this->create($data);

        }

        return $this->error();
    }

    public function deleteFile($request)
    {
        //[0] = http, [2] = server name, [3] = base media folder, [4] = item name folder, [5] = item id folder, [6] = item type folder, [7] = item name with extension
        $path = explode( '/', $request->post('path'));
        $name = explode('.', $path[7]);

        $productID = $path[5];
        $folder = $path[4];
        $localPath = $path[3].'/'.$path[4].'/'.$path[5].'/'.$path[6];

        $file = $this->productGallery::where('name', $name[0])->where('product_id', $path[5])->where('path', $localPath)->firstOrFail();

        if (Storage::disk('media')->exists($file->getName($folder, $productID, $file->type, $file->name, $file->extension))) {
            if (Storage::disk('media')->delete($file->getName($folder, $productID, $file->type, $file->name, $file->extension))) {
                return response()->json($file->delete());
            }
        }

        return response()->json(false);
    }

}
