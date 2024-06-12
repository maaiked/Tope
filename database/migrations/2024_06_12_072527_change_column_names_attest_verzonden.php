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
        Schema::table('inschrijvingsdetails', function (Blueprint $table) {
                $table->renameColumn('deelnemersattestVerzonden', 'fiscaalAttest');
                $table->renameColumn('ziekenfondsattestVerzonden', 'ziekenfondsAttest');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inschrijvingsdetail', function (Blueprint $table) {
            //
        });
    }
};
