<?php

use App\Enums\CalculusProtocolEnum;
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
        Schema::create('circumferences', function (Blueprint $table) {
            $table->id();

            $table->foreignId('physical_evaluation_id')->constrained('physical_evaluations')->onDelete('cascade')->unique();

            $table->float('circ_neck_mm')->nullable();
            $table->float('circ_chest_mm')->nullable();
            $table->float('circ_waist_mm')->nullable();
            $table->float('circ_abdomen_mm')->nullable();
            $table->float('circ_hip_mm')->nullable();
            $table->float('circ_arm_mm')->nullable();
            $table->float('circ_thigh_mm')->nullable();
            $table->float('circ_calf_mm')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('circumferences');
    }
};
