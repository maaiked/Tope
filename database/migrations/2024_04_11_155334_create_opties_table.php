<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('opties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activiteit_id');
            $table->float('prijs');
            $table->string('omschrijving');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('opties');
    }
};
