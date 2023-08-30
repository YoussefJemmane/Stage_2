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
        Schema::create('frais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->nullable();
            $table->string('region')->nullable();
            $table->string('description');
            $table->string('shift')->nullable();
            $table->date('date');
            $table->float('montant');
            $table->string('status_RA')->nullable();
            $table->string('status_DT')->nullable();
            $table->string('status_PM')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('frais');
    }
};
