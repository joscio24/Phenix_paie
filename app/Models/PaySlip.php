<?php

// app/Models/PaySlip.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaySlip extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'title',
        'grade',
        'base_salary',
        'housing_allowance',
        'transport_allowance',
        'public_services_allowance',
        'tax_paye',
        'cnss',
        'total_deductions',
        'gross_salary',
        'net_salary',
        'payment_date',
        'reference_number',
    ];

    // Relationship: Payslip belongs to an Employee
    

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
