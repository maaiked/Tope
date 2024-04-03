<?php

use App\Enums\LeerjaarEnum;
use App\Enums\VakantieEnum;
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
        Schema::create('activiteits', function (Blueprint $table) {
            $table->id();
            $table->string('naam');
            $table->string('foto')->nullable();
            $table->string('omschrijving');
            $table->dateTime('starttijd');
            $table->dateTime('eindtijd');
            $table->float('prijs');
            $table->integer('capaciteit');
            $table->integer('aantalInschrijvingen')->default(0);
            $table->string('leerjaarVanaf');
            $table->string('leerjaarTot');
            $table->date('inschrijvenVanaf');
            $table->date('inschrijvenTot');
            $table->date('annulerenTot');
            $table->string('vakantie');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activiteits');
    }
};
