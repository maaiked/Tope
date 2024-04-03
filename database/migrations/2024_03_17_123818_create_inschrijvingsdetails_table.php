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
        Schema::create('inschrijvingsdetails', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kind_id')->constrained()->cascadeOnDelete();
            $table->foreignId('activiteit_id')->constrained()->cascadeOnDelete();
            $table->date('inschrijvingsdatum')->default(today());
            $table->float('prijs')->nullable();
            //$table->foreignId('betaling_id');
            $table->boolean('ingechecked')->default(false);
            $table->boolean('uitgechecked')->default(false);
            $table->date('deelnemersattestVerzonden')->nullable();
            $table->date('ziekenfondsattestVerzonden')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inschrijvingsdetails');
    }
};
