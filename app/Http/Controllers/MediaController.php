<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

use App\Repositories\MediaRepository;
use App\Http\Resources\JResource;

/**
 *
 * Class MediaController
 *
 */
class MediaController extends Controller
{
    /**
     * @var mediaRepositoryInterface
     */
    protected $mediaRepository;

    /**
     * ItemController constructor.
     * @param MediaRepository $mediaRepository
     */
    public function __construct(MediaRepository $mediaRepository)
    {
        $this->mediaRepository = $mediaRepository;
    }

    /**
     *
     */
    public function index(Request $request)
    {
        $media = $this->mediaRepository->all($request);
        return new JResource($media);
    }

    /**
     *
     */
    public function store(Request $request)
    {
        $this->mediaRepository->storeMedia($request);

        return (new JResource(['status' => 'success']))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     *
     */
    public function show(int $mediaId)
    {
        $media = $this->mediaRepository->find($mediaId);
        return new JResource($media);
    }

    /**
     *
     */
    public function update(Request $request, $mediaId)
    {
        $this->mediaRepository->update( $request->all(), $mediaId);

        return (new JResource(['status' => 'success', 'id' => $mediaId]));
    }

    /**
     *
     */
    public function destroy(int $mediaId, Request $request)
    {
        $this->mediaRepository->destroy($mediaId, $request);

        return (new JResource(['status' => 'success']));
    }

    public function createData()
    {
        //$media = $this->mediaRepository->createData();
        //return new JResource($media);
    }

    public function sort(Request $request)
    {
        $this->mediaRepository->sort($request);

        return (new JResource(['status' => 'success']));
    }
}

