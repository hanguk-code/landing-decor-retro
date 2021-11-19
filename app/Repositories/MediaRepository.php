<?php

namespace App\Repositories;

use App\Http\Resources\JResource;
use App\Models\Product\OcProductImage;
use App\Models\Product\ProductGallery;

use Illuminate\Support\Facades\Config;
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
     * @param OcProductImage $productGallery
     */
    public function __construct(
        OcProductImage $productGallery
    )
    {
        $this->productGallery = $productGallery;
    }


    public function all($request)
    {
        $itemType = $request->input('item_type');

        if ($itemType == 'product') {
            $model = new $this->productGallery;
            $itemColumn = 'product_id';
        }

        $id = null;
        $pID = $request['item_id'];

        if (!is_null($id)) {
            $response = $model::findOrFail($id);
        } else {
            $files = $model::where($itemColumn, $pID)
                ->orderBy('sort_order', 'asc')
                ->paginate(6);

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

        if ($itemType == 'product') {
            $model = new $this->productGallery;
            $sorted = $this->productGallery->where('product_id', $mediaData['item_id'])->orderBy('sort_order', 'DESC')->first();
            $input['product_id'] = $mediaData['item_id'];
        }

        $input['image_url'] = $mediaData['path'];
        $input['image'] = $mediaData['name'];
        if (isset($sorted->sort_order)) {
            $input['sort_order'] = $sorted->sort_order + 1;
        } else {
            $input['sort_order'] = 1;
        }
        $model->create($input);
    }


    public function destroy(int $id, $request)
    {
        $itemType = $request->input('item_type');

        if ($itemType == 'product') {
            $this->productGallery->find($id)->delete();
        }
    }


    public function sort($request)
    {
        $itemType = $request->input('item_type');

        $files = $request['files'];
        $position = $this->productGallery->find($files[0]['product_image_id']);
        $i = $position->sort_order;
        foreach ($files as $file) {
            $productMedia = $this->productGallery->find($file['product_image_id']);
            $productMedia->sort_order = $i;
            $productMedia->save();
            $i++;
        }

    }

    public function storeMedia($request)
    {
        $file = $request->file;
        $estId = $request->id;
        $folder = $request->item_type;

        $filename = $file->getClientOriginalName();

        $productMedia = new $this->productGallery; //for image types

        $originalExt = $file->getClientOriginalExtension();
        $type = $productMedia->getType($originalExt);

        $getExt = preg_replace('/^.*\.([^.]+)$/D', '$1', $filename);
        $filenameWithoutExtension = explode($getExt, $filename);
        $nativeFileName = mb_substr($filenameWithoutExtension[0], 0, -1);

        $path = public_path('image/' . $folder . '/' . $estId . '/');

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        if (File::put($path . $nativeFileName . '.' . $originalExt, File::get($file))) {
            $fullPath = $path . $nativeFileName . '.' . $originalExt;
            $data = ['media_data' => [
                'path' => $fullPath,
                'name' => $folder . '/' . $estId . '/' . $nativeFileName . '.' . $originalExt,
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
        $path = explode('/', $request->post('path'));
        $name = explode('.', $path[7]);

        $productID = $path[5];
        $folder = $path[4];
        $localPath = $path[3] . '/' . $path[4] . '/' . $path[5] . '/' . $path[6];

        $file = $this->productGallery::where('name', $name[0])->where('product_id', $path[5])->where('path', $localPath)->firstOrFail();

        if (Storage::disk('media')->exists($file->getName($folder, $productID, $file->type, $file->name, $file->extension))) {
            if (Storage::disk('media')->delete($file->getName($folder, $productID, $file->type, $file->name, $file->extension))) {
                return response()->json($file->delete());
            }
        }

        return response()->json(false);
    }

    public function deleteGallery($product_id) {
        $files = $this->productGallery::where('product_id', $product_id);
        if($files->count() > 0) {
            foreach($files->get() as $file) {
                if (File::exists('image/'.$file->image)) {
                    File::delete('image/'.$file->image);
                }
                $file->delete();
            }
            return response()->json(true);
        }
        return response()->json(false);
    }

}
