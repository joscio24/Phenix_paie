<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom', 'slogan', 'ifu', 'date_creation', 'adresse',
        'telephone', 'email', 'logo', 'registration_number',
        'website', 'industry_type', 'description'
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
