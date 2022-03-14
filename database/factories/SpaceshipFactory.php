<?php declare(strict_types=1);

namespace Database\Factories;

use App\Models\Armament;
use App\Models\Spaceship;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SpaceshipFactory
 * @package Database\Factories
 * @extends Factory<Spaceship>
 */
class SpaceshipFactory extends Factory
{
    /**
     * @var class-string<Model|Spaceship>
     */
    protected $model = Spaceship::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'      => $this->faker->lastName,
            'class'     => $this->faker->company,
            'crew'      => $this->faker->numberBetween(1, 999),
            'image'     => $this->faker->imageUrl(),
            'value'     => $this->faker->randomFloat(2, 0.01, 999999.99),
            'status_id' => Status::inRandomOrder()->first()->id,
        ];
    }
}
