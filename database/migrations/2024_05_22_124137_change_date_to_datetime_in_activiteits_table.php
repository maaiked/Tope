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
        Schema::table('activiteits', function (Blueprint $table) {
            $table->dateTime('inschrijvenVanaf')->change();
            $table->dateTime('inschrijvenTot')->change();
            $table->dateTime('annulerenTot')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activiteits', function (Blueprint $table) {
            //
        });
    }
};
