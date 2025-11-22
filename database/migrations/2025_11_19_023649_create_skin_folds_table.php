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
        Schema::create('skin_folds', function (Blueprint $table) {
            $table->id();

            $table->foreignId('physical_evaluation_id')->constrained('physical_evaluations')->onDelete('cascade')->unique();

            $table->float('fold_triceps_mm')->nullable();
            $table->float('fold_biceps_mm')->nullable();
            $table->float('fold_subscapular_mm')->nullable();
            $table->float('fold_chest_mm')->nullable();
            $table->float('fold_midaxillary_mm')->nullable();
            $table->float('fold_suprailiac_mm')->nullable();
            $table->float('fold_abdominal_mm')->nullable();
            $table->float('fold_thigh_mm')->nullable();
            $table->float('fold_calf_mm')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skin_folds');
    }
};
