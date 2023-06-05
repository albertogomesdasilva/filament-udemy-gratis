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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->text('description');
            $table->string('country');
            $table->string('city');
            $table->string('address');
            $table->unsignedInteger('price');
            $table->unsignedInteger('sqm');
            $table->unsignedSmallInteger('bedrooms')->nullable();
            $table->unsignedSmallInteger('bathrooms')->nullable();
            $table->unsignedSmallInteger('garages')->nullable();
            $table->boolean('slider')->default(false);
            $table->boolean('visible')->default(true);
            $table->date('start_date')->default('2022-01-01');
            $table->date('end_date')->default('2023-01-01');

            $table->softDeletes();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
