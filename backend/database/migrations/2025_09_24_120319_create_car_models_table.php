<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('car_models', function (Blueprint $table) {
            $table->id();
            $table->string('brand')->comment('марка автомобиля');
            $table->string('model')->comment('модель автомобиля');
            $table->foreignId('comfort_category_id')->constrained()->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['brand', 'model', 'comfort_category_id'], 'car_models_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_models');
    }
};
