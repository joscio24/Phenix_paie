<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('avances_retenues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employe_id')->constrained('employees')->onDelete('cascade');
            $table->foreignId('periode_fiscale_id')->constrained('periode_exercices')->onDelete('cascade');
            $table->enum('type', ['avance', 'retenue']);
            $table->decimal('montant', 10, 2);
            $table->decimal('reste_a_percevoir', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('avances_retenues');
    }
};
