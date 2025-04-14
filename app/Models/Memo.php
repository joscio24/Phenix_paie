<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'sent_by', 'recipient', 'status'];

    public function sender()
    {
        return $this->belongsTo(Employee::class, 'sent_by');
    }

    public function receiver()
    {
        return $this->belongsTo(Employee::class, 'recipient');
    }
}
