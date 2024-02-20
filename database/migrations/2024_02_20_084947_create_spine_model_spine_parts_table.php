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
        Schema::create('spine_model_spine_parts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('spine_model_id');
            $table->unsignedBigInteger('spine_part_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spine_model_spine_parts');
    }
};
