<?php declare(strict_types=1);

namespace Database\Factories;

use App\Models\Armament;
use App\Models\ArmamentItem;
use App\Models\Spaceship;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ArmamentItemFactory
 * @package Database\Factories
 * @extends Factory<ArmamentItem>
 */
class ArmamentItemFactory extends Factory
{
    /**
     * @var class-string<Model|Armament>
     */
    protected $model = ArmamentItem::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'armament_id'  => Armament::inRandomOrder()->first()->id,
            'spaceship_id' => Spaceship::inRandomOrder()->first()->id,
            'qty'          => $this->faker->numberBetween(1, 999),
        ];
    }
}
