<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Category extends Model
{
    use HasFactory, SoftDeletes, HasSlug;

    protected $fillable = ['name', 'slug', 'description', 'image', 'sort_order', 'status'];

    protected $casts = ['status' => 'boolean'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug');
    }

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
}
