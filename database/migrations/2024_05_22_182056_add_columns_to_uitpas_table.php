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
        Schema::table('uitpas', function (Blueprint $table) {
            $table->string('api_url');
            $table->string('io_url');
            $table->string('account_url');
            $table->string('organizerId');
            $table->string('locationId');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('uitpas', function (Blueprint $table) {
            //
        });
    }
};
