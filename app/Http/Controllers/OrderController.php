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
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index(Request $request)
    {
        $order = $this->orderRepository->all($request);

        return new JResource($order);
    }

    public function optionsData(Request $request)
    {
        $data = $this->orderRepository->optionsData($request);

        return new JResource($data);
    }

    public function show(int $categoryId)
    {
        return new JResource($this->orderRepository->find($categoryId));
    }

    public function update(Request $request, $categoryId)
    {
        $this->orderRepository->update($request->all(), $categoryId);

        return (new JResource(['status' => 'success', 'id' => $categoryId]));
    }

}
