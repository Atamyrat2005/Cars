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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('brand_id')->index();
            $table->foreign('brand_id')->references('id')->on('brands')->cascadeOnDelete();
            $table->unsignedBigInteger('location_id')->index();
            $table->foreign('location_id')->references('id')->on('locations')->cascadeOnDelete();
            $table->unsignedBigInteger('year_id')->index();
            $table->foreign('year_id')->references('id')->on('years')->cascadeOnDelete();
            $table->unsignedBigInteger('color_id')->index();
            $table->foreign('color_id')->references('id')->on('colors')->cascadeOnDelete();
            $table->text('description')->nullable();
            $table->unsignedDouble('price')->default(0);
            $table->unsignedInteger('viewed')->default(0);
            $table->boolean('active')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
