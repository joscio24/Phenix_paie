<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvanceRetenue extends Model
{
    use HasFactory;

    protected $fillable = ['employe_id', 'periode_fiscale_id', 'type', 'montant', 'reste_a_percevoir'];
    protected $table = 'avances_retenues';

    public function employe()
    {
        return $this->belongsTo(Employee::class);
    }

    public function periodeFiscale()
    {
        return $this->belongsTo(PeriodeExercice::class);
    }
}

