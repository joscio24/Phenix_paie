<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_taxes_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxesTable extends Migration
{
    public function up()
    {
        Schema::create('taxes', function (Blueprint $table) {
            $table->id(); // ID unique généré automatiquement
            $table->string('name'); // Nom de la taxe
            $table->decimal('rate', 5, 2); // Taux
            $table->string('base_calculation'); // Base de calcul
            $table->boolean('is_active')->default(true); // Statut
            $table->timestamps(); // Champs de timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('taxes');
    }
}
