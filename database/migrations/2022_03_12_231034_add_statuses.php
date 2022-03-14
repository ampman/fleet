<?php declare(strict_types=1);

use App\Models\Status;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Status::create([
            'title' => 'Operational',
            'slug'  => 'operational',
        ]);

        Status::create([
            'title' => 'Damaged',
            'slug'  => 'damaged',
        ]);

        Status::create([
            'title' => 'Renewed',
            'slug'  => 'renewed',
        ]);

        Status::create([
            'title' => 'Let',
            'slug'  => 'let',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('statuses')->truncate();
    }
};
