<?php declare(strict_types=1);

use App\Models\Armament;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Armament::create([
            'title' => 'Turbo Laser',
            'slug'  => 'turbo-laser',
        ]);

        Armament::create([
            'title' => 'Ion Cannons',
            'slug'  => 'ion-cannons',
        ]);

        Armament::create([
            'title' => 'Tractor Beam',
            'slug'  => 'tractor-beam',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('armament')->truncate();
    }
};
