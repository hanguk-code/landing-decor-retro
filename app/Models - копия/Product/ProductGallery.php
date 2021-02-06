<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductGallery extends Model
{
    public $table = 'product_gallery';

    protected $dateFormat = 'Y-m-d H:i:s';

    protected $fillable = [
        'product_id',
        'name',
        'image_url',
        'sort_order',
        
        'created_at',
        'updated_at',
    ];

    public static $image_ext = ['jpg', 'jpeg', 'png', 'gif'];
    public static $audio_ext = ['mp3', 'ogg', 'mpga'];
    public static $video_ext = ['mp4', 'mpeg', 'mov'];
    public static $document_ext = ['doc', 'docx', 'pdf', 'odt'];


    /**
     * Get type by extension
     * @param  string $ext Specific extension
     * @return string      Type
     */
    public function getType($ext)
    {
        if (in_array($ext, self::$image_ext)) {
            return 'image';
        }

        if (in_array($ext, self::$audio_ext)) {
            return 'audio';
        }

        if (in_array($ext, self::$video_ext)) {
            return 'video';
        }

        if (in_array($ext, self::$document_ext)) {
            return 'document';
        }
    }
}