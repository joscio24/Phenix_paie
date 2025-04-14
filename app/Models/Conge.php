<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Conge extends Model
{
    use HasFactory;
    protected $fillable = ['id_employee', 'date_debut', 'date_fin', 'statut', 'etat'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'id_employee');
    }
}

