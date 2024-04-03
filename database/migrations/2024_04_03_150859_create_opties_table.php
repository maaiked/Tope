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
        Schema::create('opties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activiteit_id')->constrained()->cascadeOnDelete();
            $table->float('prijs');
            $table->string('omschrijving');
            $table->date('datum');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opties');
    }
};
