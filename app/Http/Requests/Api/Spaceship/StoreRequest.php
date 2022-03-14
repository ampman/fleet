<?php declare(strict_types=1);

namespace App\Http\Requests\Api\Spaceship;

use App\Http\Requests\Api\Request;
use Illuminate\Database\Schema\Builder;

/**
 * Class StoreRequest
 * @package App\Http\Requests\Spaceship
 */
class StoreRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'      => sprintf('bail|required|string|max:%d', Builder::$defaultStringLength),
            'class'     => sprintf('bail|required|string|max:%d', Builder::$defaultStringLength),
            'crew'      => 'bail|required|integer',
            'image'     => 'bail|required|url',
            'value'     => 'bail|required|digits_between:0.01,999999.99',
            'status_id' => 'bail|required|exists:statuses,id',
        ];
    }
}
