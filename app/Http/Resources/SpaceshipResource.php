<?php declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class SpaceshipResource
 * @package App\Http\Resources
 */
class SpaceshipResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'       => $this->resource->id,
            'name'     => $this->resource->name,
            'class'    => $this->resource->class,
            'crew'     => $this->resource->crew,
            'image'    => $this->resource->image,
            'status'   => (new StatusResource($this->resource->status))->title,
            'armament' => new ArmamentItemResource($this->resource->armament),
        ];
    }
}
