<?php declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->index();
        });

        Schema::create('spaceships', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('class');
            $table->unsignedInteger('crew');
            $table->string('image');
            $table->unsignedDecimal('value');
            $table->unsignedBigInteger('status_id')->index();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('status_id')
                ->references('id')
                ->on('statuses')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        Schema::create('armament', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
        });

        Schema::create('armament_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('armament_id')->index();
            $table->unsignedBigInteger('spaceship_id')->index();
            $table->unsignedInteger('qty');

            $table->unique(['armament_id', 'spaceship_id']);

            $table->foreign('armament_id')
                ->references('id')
                ->on('armament')
                ->onDelete('cascade');

            $table->foreign('spaceship_id')
                ->references('id')
                ->on('spaceships')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('armament_items');
        Schema::dropIfExists('armament');
        Schema::dropIfExists('spaceships');
        Schema::dropIfExists('statuses');
    }
};
