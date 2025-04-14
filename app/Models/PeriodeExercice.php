<?php

namespace App\Models;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PeriodeExercice extends Model
{
    use HasFactory;

    protected $fillable = ['date_debut', 'date_fin'];
    protected $table = 'periode_exercices'; //
    // Méthode pour générer automatiquement la période de février
    public static function generateFiscalPeriod($month)
    {
        $year = date('Y');
        $firstDayOfMonth = Carbon::create($year, $month, 1)->startOfMonth();
        $lastDayOfMonth = Carbon::create($year, $month, 1)->endOfMonth();

        return self::create([
            'date_debut' => $firstDayOfMonth->format('Y-m-d'),
            'date_fin' => $lastDayOfMonth->format('Y-m-d')
        ]);
    }
}
