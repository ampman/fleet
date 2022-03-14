<?php declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Armament;
use App\Models\ArmamentItem;
use App\Models\Spaceship;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

/**
 * Class SpaceshipSeeder
 * @package Database\Seeders
 */
class SpaceshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $spaceships = Spaceship::factory(10)->create();

        $armament = Armament::pluck('id');

        $spaceships->each(function (Spaceship $spaceship) use ($armament) {
            $count = rand(1, $armament->count());
            $randomArmament = $armament->random($count);

            $randomArmament->each(function (int $armamentId) use ($spaceship) {
                ArmamentItem::factory()->create([
                    'armament_id' => $armamentId,
                    'spaceship_id' => $spaceship->id,
                ]);
            });
        });
    }
}
