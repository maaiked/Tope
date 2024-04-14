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
        Schema::create('inschrijvingsdetail_opties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inschrijvingsdetail_id')->constrained()->cascadeOnDelete();
            $table->foreignId('optie_id')->constrained()->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inschrijvingsdetail_opties');
    }
};
