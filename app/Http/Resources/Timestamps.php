<?php declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Database\Eloquent\Model;

/**
 * trait Timestamps
 * @package App\Http\Resources
 */
trait Timestamps
{
    /**
     * @param Model $item
     * @param array $data
     * @return array
     */
    public function withTimestamps(Model $item, array $data = []): array
    {
        return array_merge($data, [
            'created_at' => data_get($item, 'created_at'),
            'updated_at' => data_get($item, 'updated_at'),
        ]);
    }
}
