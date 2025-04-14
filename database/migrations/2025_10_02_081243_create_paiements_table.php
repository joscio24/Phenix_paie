<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees');
            $table->date('temps_de_travail_a_payer_debut');
            $table->date('temps_de_travail_a_payer_fin');
            $table->decimal('salaire_base', 10, 2);
            $table->foreignId('periode_fiscale_id')->constrained('periode_exercices')->onDelete('cascade');
            $table->decimal('deduction', 5, 2); // Tax percentage
            $table->decimal('salaire_brut', 10, 2);
            $table->decimal('allocation', 10, 2)->nullable();
            $table->decimal('avance_salaire', 10, 2)->nullable();
            $table->decimal('retenue_salaire', 10, 2)->nullable();
            $table->decimal('prime', 10, 2)->nullable();
            $table->decimal('montant_a_payer', 10, 2); // Net salary after deductions
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
