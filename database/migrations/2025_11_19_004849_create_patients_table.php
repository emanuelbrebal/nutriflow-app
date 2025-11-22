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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            $table->foreignId('linked_nutritionist')
                ->nullable() 
                ->constrained('nutritionists')
                ->onDelete('set null');

            $table->date('birth_date')->nullable();
            $table->float('height')->nullable();
            $table->float('weight')->nullable();
            
            $table->integer('biological_sex')->nullable();
            $table->integer('activity_level')->nullable();
            $table->integer('main_objective')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
