<?php

namespace App\Repositories;

use App\Models\Order\Order;

class OrderRepository
{
    protected $order;

    /**
     * OrderRepository constructor.
     * @param Order $order

     */
    public function __construct(
        Order $order
    )
    {
        $this->order = $order;

    }

    public function all($request)
    {
        if ( $request->input('client') ) {
            return $this->order->all();
        }

        $columns = ['id', 'product_id', 'name', 'phone', 'email', 'comment', 'updated_at'];

        $length      = $request->input('length');
        $column      = $request->input('column'); //Index
        $dir         = $request->input('dir');
        $searchValue = $request->input('search');

        $query = $this->order->select('id', 'product_id', 'name', 'phone', 'email', 'comment', 'created_at', 'updated_at')
            ->orderBy($columns[$column], $dir);

        if ($searchValue) {
            $query->where(function($query) use ($searchValue) {
                $query->where('id',         'like', '%' . $searchValue . '%')
                    ->orWhere('name',       'like', '%' . $searchValue . '%')
                    ->orWhere('phone',     'like', '%' . $searchValue . '%')
                    ->orWhere('email',     'like', '%' . $searchValue . '%')
                    ->orWhere('comment',     'like', '%' . $searchValue . '%')
                    ->orWhere('created_at', 'like', '%' . $searchValue . '%')
                    ->orWhere('updated_at', 'like', '%' . $searchValue . '%');
            });
        }

        $data = $query->paginate($length);
        $columns = array (
            array('width' => '33%', 'label' => 'Id',     'name' => 'id'),
            array('width' => '33%','label' => 'Товар', 'name' => 'product_id', 'type' => 'product_id'),
            array('width' => '33%', 'label' => 'Имя',   'name' => 'name'),
              array('width' => '33%', 'label' => 'Телефон',   'name' => 'phone'),
                array('width' => '33%', 'label' => 'Почта',   'name' => 'email'),
               array('width' => '33%', 'label' => 'Комментарий',   'name' => 'comment'),
            array('width' => '33%', 'label' => 'Даты',  'name' => 'dates')
        );

        // $statusClass = array (
        //     array('status' => 'inactive',   'badge' => 'kt-badge--danger'),
        //     array('status' => 'active', 'badge' => 'kt-badge--success')
        // );

        $sortKey = 'id';

        return [
            'data'        => $data,
            'columns'     => $columns,
            //'statusClass' => $statusClass,
            'sortKey'     => $sortKey,
            'draw'        => $request->input('draw')
        ];
    }


}
