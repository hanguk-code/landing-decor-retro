<?php

namespace App\Http\Controllers\Web;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Repositories\Web\ProductRepository;
use App\Http\Resources\JResource;

/**
 *
 * Class ProductController
 *
 * @package  App\Http\Controllers
 */
class ProductController extends Controller
{
    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * ItemController constructor.
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     *
     */
    public function index(Request $request)
    {
        $product = $this->productRepository->all($request);
        return new JResource($product);
    }

    public function newLimit(Request $request)
    {
        $product = $this->productRepository->newLimit($request);
        return new JResource($product);
    }

    public function newAll(Request $request)
    {
        $product = $this->productRepository->newAll($request);
        return new JResource($product);
    }
    public function related(Request $request)
    {
        $product = $this->productRepository->related($request);
        return new JResource($product);
    }

    public function archiveAll(Request $request)
    {
        $product = $this->productRepository->archiveAll($request);
        return new JResource($product);
    }

    /**
     *
     */
    public function show(int $productId)
    {
        $product = $this->productRepository->find($productId);
        return new JResource($product);
    }

    public function optionsData()
    {
        $product = $this->productRepository->optionsData();

        return new JResource($product);
    }

    public function type(Request $request, $url)
    {
        $data = $this->productRepository->type($request, $url);

        return new JResource($data);
    }

    public function search(Request $request)
    {
       $data = $this->productRepository->search($request);

        return new JResource($data);
    }

    public function getProduct(Request $request)
    {
        $product = $this->productRepository->getProduct($request);

        return new JResource($product);
    }

}

