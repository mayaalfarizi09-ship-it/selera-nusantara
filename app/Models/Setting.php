<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'restaurant_name', 'tagline', 'logo', 'favicon', 'address', 'phone',
        'whatsapp', 'email', 'instagram', 'facebook', 'youtube', 'tiktok',
        'opening_hours', 'google_maps_embed', 'meta_title', 'meta_description',
    ];

    protected $casts = [
        'opening_hours' => 'array',
    ];

    public static function current(): self
    {
        return static::query()->firstOrCreate([], ['restaurant_name' => 'Selera Nusantara']);
    }
}
