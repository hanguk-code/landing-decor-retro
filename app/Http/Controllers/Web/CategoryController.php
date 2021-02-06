<?php

namespace App\Http\Controllers\Web;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Repositories\Web\CategoryRepository;
use App\Http\Resources\JResource;

/**
 *
 * Class CategoryController
 *
 * @package  App\Http\Controllers
 */
class CategoryController extends Controller
{

    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * CategoryController constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index(Request $request)
    {
        $category = $this->categoryRepository->all($request);
        return new JResource($category);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $categoryId
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show($categoryId)
    {
        $category = $this->categoryRepository->find($categoryId);
        return new JResource($category);
    }

    public function optionsData(Request $request)
    {
        $data = $this->categoryRepository->optionsData($request);

        return new JResource($data);
    }
}
