<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

use App\Repositories\OrderRepository;
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
     * @var CategoryRepository
     */
    protected $orderRepository;

    /**
     * OrderController constructor.
     * @param CategoryRepository $orderRepository
     */
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index(Request $request)
    {
        $order = $this->orderRepository->all($request);

        return new JResource($order);
    }
}
