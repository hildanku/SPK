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
        Schema::create('foods', function (Blueprint $table) {
            $table->bigIncrements('foodId');
            $table->string('foodName');
            $table->text('foodDesc');
            $table->float('foodTasteRating');
            $table->float('foodRiskDiseaseRating');
            $table->float('foodAgeSuitability');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foods');
    }
};
