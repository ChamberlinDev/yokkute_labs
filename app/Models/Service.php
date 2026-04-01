<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'title_en',
        'slug',
        'badge',
        'badge_en',
        'badge_variant',
        'icon',
        'accent_color',
        'description',
        'description_en',
        'audience',
        'audience_en',
        'deliverables',
        'deliverables_en',
        'image_path',
        'cta_label',
        'cta_label_en',
        'cta_url',
        'cta_url_en',
        'order_column',
        'is_published',
    ];

    protected $casts = [
        'deliverables' => 'array',
        'deliverables_en' => 'array',
        'is_published' => 'boolean',
    ];
}
