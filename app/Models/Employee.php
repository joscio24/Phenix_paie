<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Enums\TypeDeContratEnum;


class Employee extends Model
{
    use HasFactory;

    // Define the fillable attributes
    // protected $fillable = [
    //     'full_name',
    //     'employee_id', // Added based on the controller's request validation
    //     'naissances',
    //     'poste',
    //     'is_active',
    //     'type_de_contrat',
    //     'salaire_brut',
    //     'taxe',
    //     'num_CNSS',
    //     'date_de_prise_de_service',
    //     'date_de_fin_de_contrat',
    //     'nombre_heure_par_semaine',
    //     'bank_account', // Added based on the controller's request validation
    // ];

    protected $casts = [
        'type_contrat' => TypeDeContratEnum::class,  // Cast the contract type to Enum
    ];

    protected $fillable = [
        'nom', 'prenoms', 'date_naissance', 'sexe', 'etat_civil', 'adresse',
        'telephone', 'email', 'photo_identite', 'employee_id', 'poste', 'departement',
        'date_embauche', 'type_de_contrat', 'duree_contrat', 'lieu_affectation', 'salaire_base',
        'mode_paiement', 'compte_bancaire', 'nom_banque', 'frequence_paiement',
        'num_securite_sociale', 'num_ifu', 'retraite', 'taxe_appliquee', 'cotisation_appliquee', 'nombre_heure_sem_assignee', 'nombre_heure_assignee',
        'contrat_signe', 'carte_identite', 'certificats_diplomes', 'rib',
    ];
    // Define relationships
    public function paySlips()
    {
        return $this->hasMany(PaySlip::class);
    }

    public function sentMemos()
    {
        return $this->hasMany(Memo::class, 'sent_by');
    }
    public function salaires()
    {
        return $this->hasMany(Salary::class, 'id_employe');
    }

    public function primes()
    {
        return $this->hasMany(Prime::class, 'id_employe');
    }

    public function cotisations()
    {
        return $this->hasMany(Cotisation::class, 'id_employe');
    }

    public function conges()
    {
        return $this->hasMany(Conge::class, 'id_employe');
    }
    public function receivedMemos()
    {
        return $this->hasMany(Memo::class, 'recipient');
    }
}
