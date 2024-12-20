<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{

    protected $fillable = [
        'user_id',
        'isi',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // In app/Models/User.php
    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }// In app/Models/Proposal.php
    protected $table = 'draft_proposal';
}