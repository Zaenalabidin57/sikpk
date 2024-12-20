<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tanggal_Submisi extends Model
{
    protected $fillable = [
        'start_date',
        'end_date',
        'is_active',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
    ];
    protected $table = 'submission_period';
}