<?php declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\ArmamentItem;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ArmamentItemResource
 * @package App\Http\Resources
 */
class ArmamentItemResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return $this->resource->map(function (ArmamentItem $armamentItem) use ($request) {
            $armamentResource = new ArmamentResource($armamentItem->armament);
            return [
                'title' => $armamentResource->title,
                'qty' => $armamentItem->qty,
            ];
        })->toArray();
    }
}
