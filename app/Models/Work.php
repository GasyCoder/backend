<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Work extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'image',
        'client_name',
        'year',
        'technologies',
        'url',
        'is_featured',
        'position',
    ];

    protected $casts = [
        'technologies' => 'array',
        'is_featured' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($work) {
            if (empty($work->slug)) {
                $work->slug = Str::slug($work->title);
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
