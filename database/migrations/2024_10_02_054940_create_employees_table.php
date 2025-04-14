<?php

use App\Enums\TypeDeContratEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenoms');
            $table->date('date_naissance');
            $table->enum('sexe', ['Masculin', 'Féminin', 'Autres']);
            $table->enum('etat_civil', ['Mr', 'Mme', 'Mlle']);
            $table->text('adresse');
            $table->string('telephone');
            $table->string('email');
            $table->string('photo_identite')->nullable();

            // Professional Information
            $table->string('employee_id')->unique();
            $table->string('poste');
            $table->string('departement');
            $table->date('date_embauche');
            $table->enum('type_de_contrat', TypeDeContratEnum::getValues())  // Use the enum values
                ->default(TypeDeContratEnum::CDI);
                $table->integer('duree_contrat');
            $table->string('lieu_affectation');

            // Salary Information
            $table->decimal('salaire_base', 10, 2);
            $table->enum('mode_paiement', ['Virement bancaire', 'Chèque', 'Espèces']);
            $table->string('compte_bancaire');
            $table->string('nom_banque');
            $table->enum('frequence_paiement', ['Mensuel', 'Bimensuel']);

            // Fiscal and Social Status
            $table->string('num_securite_sociale');
            $table->string('num_ifu');
            $table->boolean('retraite')->default(false);
            $table->integer('taxe_appliquee')->default(7);
            $table->integer('cotisation_appliquee')->nullable();

            // Document Uploads
            // nombre_heure_sem_assignee
            $table->string('nombre_heure_sem_assignee')->required();
            $table->string('nombre_heure_assignee')->required();
            $table->string('contrat_signe')->nullable();
            $table->string('carte_identite')->nullable();
            $table->string('certificats_diplomes')->nullable();
            $table->string('rib')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
