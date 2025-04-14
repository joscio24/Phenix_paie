<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffApplication extends Model
{
    use HasFactory;

    protected $fillable = ['total_applications', 'pending', 'approved', 'rejected'];
}
