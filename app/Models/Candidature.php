<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidature extends Model
{
    use HasFactory;

    protected $fillable = [
        'prenom',
        'nom',
        'email',
        'telephone',
        'domaine',
        'experience',
        'portfolio',
        'message',
        'cv_path',
        'rh_notified_at',
        'status',
        'reviewed_at',
    ];

    protected $casts = [
        'rh_notified_at' => 'datetime',
        'reviewed_at' => 'datetime',
    ];
}
