<?php declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Request extends FormRequest
{
    /**
     * Get only input data explicitly allowed in rules.
     *
     * @return array
     */
    public function processed(): array
    {
        return $this->validated();
    }
}
