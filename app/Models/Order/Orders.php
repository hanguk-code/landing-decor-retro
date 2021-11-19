<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

use App\Models\Product\Product;

class Orders extends Model
{
    public $table = 'orders';

    protected $dateFormat = 'Y-m-d H:i:s';

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'order_id',
        'name',
        'phone',
        'email',
        'type',
    ];

}
