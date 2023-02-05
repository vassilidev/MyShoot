<?php

use App\Enums\GenderEnum;
use App\Models\Role;
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
        Schema::create('people', static function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Role::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('gender', array_column(GenderEnum::cases(), 'value'))->nullable();
            $table->string('name');
            $table->string('surname');
            $table->string('bip')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->bigInteger('nbr_photos')->default(0);
            $table->unique(['role_id', 'name', 'surname']);
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
        Schema::dropIfExists('people');
    }
};
