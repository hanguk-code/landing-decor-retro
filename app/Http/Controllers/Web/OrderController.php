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
    public function order(Request $request)
    {
        $this->orderRepository->order($request);
        return new JResource(['status' => 'success']);
    }
}
