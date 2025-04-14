<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    //
    protected $table = 'salaires';
    protected $primaryKey = 'id_salaire';

    protected $fillable = [
        'id_employe',
        'mois',
        'annee',
        'sal_brute',
        'deduction',
        'sal_net'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'id_employe');
    }
}
