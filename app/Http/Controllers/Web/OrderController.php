<?php

namespace App\Http\Controllers\Web;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Repositories\Web\OrderRepository;
use App\Http\Resources\JResource;

/**
 *
 * Class OrderController
 *
 * @package  App\Http\Controllers
 */
class OrderController extends Controller
{

    /**
     * @var OrderRepository
     */
    protected $orderRepository;

    /**
     * OrderController constructor.
     * @param OrderRepository $orderRepository
     */
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function order(Request $request)
    {
        $this->orderRepository->order($request);
        return new JResource(['status' => 'success']);
    }
}
