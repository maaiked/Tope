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
            $table->string('uitdatabank_id');
            $table->string('uitdatabank_url');
            $table->string('uitdatabank_kansentarief');
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
