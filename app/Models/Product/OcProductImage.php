<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class OcProductImage extends Model
{
    protected $table = 'oc_product_image';
    protected $primaryKey = 'product_image_id';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_image_id',
        'product_id',
        'image',
        'sort_order',
    ];

    public static $image_ext = ['jpg', 'jpeg', 'png', 'gif'];
    public static $audio_ext = ['mp3', 'ogg', 'mpga'];
    public static $video_ext = ['mp4', 'mpeg', 'mov'];
    public static $document_ext = ['doc', 'docx', 'pdf', 'odt'];

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
