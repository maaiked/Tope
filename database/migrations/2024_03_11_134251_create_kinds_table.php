<?php

use App\Enums\LeerjaarEnum;
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
        Schema::create('kinds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('voornaam');
            $table->string('familienaam');
            $table->string('contactpersoon');
            $table->string('allergie')->nullable();
            $table->string('beperking')->nullable();
            $table->string('medicatie')->nullable();
            $table->boolean('alleenNaarHuis')->default(false);
            $table->string('afhalenKind')->nullable();
            $table->boolean('fotoToestemming');
            $table->string('rijksregisternummer');
            $table->string('leerjaar')->default(LeerjaarEnum::KL1->value);
            $table->string('uitpasnummer')->nullable();
            $table->string('uitpasKansentarief')->nullable();
            $table->date('uitpasDatumCheck')->nullable();
            $table->string('infoAdminAnimator')->nullable();
            $table->string('infoAdmin')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kinds');
    }
};
