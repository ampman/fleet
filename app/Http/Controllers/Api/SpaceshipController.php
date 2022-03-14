<?php declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Spaceship\StoreRequest;
use App\Http\Requests\Api\Spaceship\UpdateRequest;
use App\Http\Resources\SpaceshipListingResource;
use App\Http\Resources\SpaceshipResource;
use App\Models\Spaceship;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class SpaceshipController
 * @package App\Http\Controllers\Api
 */
class SpaceshipController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return SpaceshipListingResource::collection(
            Spaceship::paginate(2)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $spaceship = new Spaceship();
        $spaceship->fill($request->processed());
        $spaceship->save();
        return $this->respondSuccess();
    }

    /**
     * Display the specified resource.
     *
     * @param Spaceship $spaceship
     * @return JsonResponse
     */
    public function show(Spaceship $spaceship): JsonResponse
    {
        $resource = new SpaceshipResource($spaceship);
        return response()->json($resource);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Spaceship $spaceship
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Spaceship $spaceship): JsonResponse
    {
        $spaceship->fill($request->processed());
        $spaceship->save();
        return $this->respondSuccess();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Spaceship $spaceship
     * @return JsonResponse
     */
    public function destroy(Spaceship $spaceship): JsonResponse
    {
        $spaceship->delete();
        return $this->respondSuccess();
    }
}
