<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frais extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
        'region',
        'shift',
        'montant',
        'date',
        'status_RA',
        'status_DT',
        'status_PM',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
