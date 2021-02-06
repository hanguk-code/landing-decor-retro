<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

use App\Repositories\CategoryRepository;
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(Request $request)
    {
        $this->categoryRepository->create($request->all());

        return (new JResource(['status' => 'success']))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $categoryId
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(Request $request, $categoryId)
    {
        $this->categoryRepository->update( $request->all(), $categoryId);

        return (new JResource(['status' => 'success', 'id' => request()->route('category')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $categoryId
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function destroy($categoryId)
    {
        $this->categoryRepository->delete($categoryId);

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function optionsData(Request $request)
    {
        $data = $this->categoryRepository->optionsData($request);

        return new JResource($data);
    }

    public function deleteChecked(Request $request)
    {
        $this->categoryRepository->deleteChecked($request);

        return (new JResource(['status' => 'success']));
    }
}
