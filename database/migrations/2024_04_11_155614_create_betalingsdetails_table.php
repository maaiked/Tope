<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('betalingsdetails', function (Blueprint $table) {
            $table->id();
            $table->date('datum');
            $table->string('methode');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('betalingsdetails');
    }
};
