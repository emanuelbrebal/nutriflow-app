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
        Schema::create('physical_evaluations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('folds_id')->constrained('folds');
            $table->foreignId('circumferences_id')->constrained('circumferences');

            $table->boolean('is_previous')->default('false');
            $table->date('evaluation_date')->nullable();

            $table->text('observations', 2000)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('physical_evaluations');
    }
};
