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
        Schema::create('results', function (Blueprint $table) {
            $table->id();

            $table->foreignId('physical_evaluation_id')->constrained()->onDelete('cascade');

            $table->float('imc'); 
            $table->float('body_fat_percentage');
            $table->float('fat_mass');
            $table->float('lean_mass'); 
            $table->float('basal_metabolic_rate');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
