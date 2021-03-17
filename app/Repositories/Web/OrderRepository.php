<?php

namespace App\Repositories\Web;

use App\Models\Order\Order;

class OrderRepository
{
    protected $order;

    /**
     * OrderRepository constructor.
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function order($request)
    {

        $productId = [];

        foreach ($request['cartData'] as $item) {
            $productId[] = $item['id'];
        }

        $this->order->create([
            'product_id' => serialize($productId),
            'name' => $request['userForm']['name'],
            'phone' => $request['userForm']['phone'],
            'email' => $request['userForm']['email'],
            'comment' => $request['userForm']['comment'],
        ]);

    }

}
