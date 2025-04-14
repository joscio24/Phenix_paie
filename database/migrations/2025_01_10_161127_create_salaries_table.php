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
        Schema::create('salaires', function (Blueprint $table) {
            $table->id('id_salaire');
            $table->foreignId('id_employe')->constrained('employees')->onDelete('cascade');
            $table->integer('mois');
            $table->integer('annee');
            $table->decimal('sal_brute', 10, 2);
            $table->decimal('deduction', 10, 2);
            $table->decimal('sal_net', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salaries');
    }
};
