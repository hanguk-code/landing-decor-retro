<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Product\Product;

class Order extends Model
{
    use SoftDeletes;
    
    public $table = 'order';

    protected $dateFormat = 'Y-m-d H:i:s';

    protected $fillable = [
        'product_id',
        'name',
        'phone',
        'email',
        'comment',

        'created_at',
        'updated_at',
        'deleted_at'
    ];

     protected $appends = ['dates'];

    public function getDatesAttribute()
    {
        return 'Р: '.$this->updated_at."<br>".'С: '.$this->created_at;
    }
}