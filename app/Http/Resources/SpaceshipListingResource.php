<?php declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class SpaceshipListingResource
 * @package App\Http\Resources
 */
class SpaceshipListingResource extends JsonResource
{
    use Timestamps;

    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'     => $this->resource->id,
            'name'   => $this->resource->name,
            'status' => (new StatusResource($this->resource->status))->title,
        ];
    }
}
