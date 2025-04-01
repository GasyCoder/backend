<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'repo_url',
        'demo_url',
        'screenshot',
        'languages',
        'technologies',
        'featured',
        'completed_at',
        'is_published'
    ];

    protected $casts = [
        'languages' => 'array',
        'technologies' => 'array',
        'featured' => 'boolean',
        'is_published' => 'boolean',
        'completed_at' => 'date',
    ];

    // Générer automatiquement un slug à partir du titre
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title);

                // S'assurer que le slug est unique
                $count = static::where('slug', $project->slug)
                    ->where('id', '!=', $project->id)
                    ->count();

                if ($count > 0) {
                    $project->slug = $project->slug . '-' . ($count + 1);
                }
            }
        });
    }

    // Accesseur personnalisé pour transformer en tableau si nécessaire
    public function getLanguagesListAttribute(): array
    {
        if (is_string($this->languages)) {
            return array_map('trim', explode(',', $this->languages));
        }
        return $this->languages ?: [];
    }

    public function getTechnologiesListAttribute(): array
    {
        if (is_string($this->technologies)) {
            return array_map('trim', explode(',', $this->technologies));
        }
        return $this->technologies ?: [];
    }

    // Scopes pour faciliter les requêtes
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }
}
