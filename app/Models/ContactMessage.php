<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'prenom',
        'nom',
        'email',
        'whatsapp',
        'entreprise',
        'besoin',
        'orientation_requested',
        'message',
        'status',
        'read_at',
    ];

    protected $casts = [
        'orientation_requested' => 'boolean',
        'read_at' => 'datetime',
    ];
}