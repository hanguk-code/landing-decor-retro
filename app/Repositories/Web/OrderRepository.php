<?php

namespace App\Repositories\Web;

use App\Models\Order\Order;
use Illuminate\Support\Facades\Mail;

class OrderRepository
{
    protected $order;
	//public $data =[];
	public $idd;
    /**
     * OrderRepository constructor.
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }
	/*public function shownumber($oid)
    {
    	$data[] = $oid;
    	$data[] = 'Text';
    	$data[] = '98';
    	//return view('mails.order_adm', $data);
    	return view('mails.order_adm')->with('iddata', $oid);
    }*/
    public function order($request)
    {
        $productId = [];

        foreach ($request['cartData'] as $item) {
            $productId[] = $item['id'];
        }

        $odata=$this->order->create([
            'product_id' => serialize($productId),
            'name' => $request['userForm']['name'],
            'phone' => $request['userForm']['phone'],
            'email' => $request['userForm']['email'],
            'comment' => $request['userForm']['comment'],
        ]);
		$idd=$odata['id'];
		if(empty($idd)) {$idd='415';}
		//$this->shownumber($idd);
		
		//$textone[] = $ordid;
		//$textone[] = 'OrderRepository';

        Mail::to($request['userForm']['email'])->send(new SendOrderForm($request,$idd));
        //Mail::to(env('EMAIL_ORDER', 'enot70@yandex.ru'))->send(new SendOrderForm($request));
        //Mail::to('vo710mail@gmail.com')->send(new SendAdminForm($request,$idd));
		Mail::to(env('EMAIL_ORDER'))->send(new SendAdminForm($request,$idd));
		
    }

}
