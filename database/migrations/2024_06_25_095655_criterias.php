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
        Schema::create('criterias', function (Blueprint $table) {
            $table->string('criteriaCode')->primary();
            $table->string('criteriaName');
            $table->text('criteriaDesc');
            $table->float('criteriaWeight');
            // 1 untuk benefit
            // 2 untuk cost
            $table->enum('criteriaType', ['benefit', 'cost']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('criterias');
    }
};
