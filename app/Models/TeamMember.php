<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'role',
        'role_en',
        'bio',
        'bio_en',
        'image_path',
        'linkedin_url',
        'order_column',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
