<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'badge',
        'badge_variant',
        'icon',
        'accent_color',
        'description',
        'audience',
        'deliverables',
        'image_path',
        'cta_label',
        'cta_url',
        'order_column',
        'is_published',
    ];

    protected $casts = [
        'deliverables' => 'array',
        'is_published' => 'boolean',
    ];
}