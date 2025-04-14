<?php

namespace App;
namespace App\Models;

use App\Models\Employee;


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'temps_de_travail_a_payer_debut',
        'temps_de_travail_a_payer_fin',
        'periode_fiscale_id',
        'salaire_base',
        'deduction',
        'salaire_brut',
        'allocation',
        'avance_salaire',
        'retenue_salaire',
        'prime',
        'montant_a_payer',
    ];


    /**
     * Relationship to the Employee model.
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * Calculate the montant_a_payer based on salaire_brut and employee's tax rate.
     * This could be a helper method for future usage.
     */
    public function calculateNetPay($salaireBrut, $taxe)
    {
        return $salaireBrut * ((100 - $taxe) / 100);
    }
}
