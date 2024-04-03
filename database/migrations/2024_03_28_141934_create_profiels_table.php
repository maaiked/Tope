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
        Schema::create('profiels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('voornaam');
            $table->string('familienaam');
            $table->string('straat');
            $table->string('huisnummer');
            $table->string('bus')->nullable();
            $table->string('postcode');
            $table->string('gemeente');
            $table->string('telefoonnummer');
            $table->string('rijksregisternummer');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiels');
    }
};
