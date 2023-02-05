<?php

use App\Models\People;
use App\Models\Shooting;
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
        Schema::create('people_shooting', static function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(People::class)->constrained();
            $table->foreignIdFor(Shooting::class)->constrained();
            $table->unique(['people_id', 'shooting_id']);
            $table->dateTime('shoot_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('people_shooting');
    }
};
