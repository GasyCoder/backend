<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'description', // Meta description pour le SEO
        'category',
        'tags', // Stocké en format JSON ou séparé par virgules
        'cover_image', // URL de l'image principale
        'published_at',
        'modified_at', // Date de dernière modification
        'read_time',
        'author_id', // Relation avec l'utilisateur qui a écrit l'article
        'is_published', // Pour gérer les brouillons
    ];

    protected $dates = ['published_at', 'modified_at', 'created_at', 'updated_at'];

    protected $casts = [
        'tags' => 'array', // Si stocké en JSON
        'is_published' => 'boolean',
    ];

    // Relation avec l'auteur
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    // Articles connexes basés sur la catégorie ou les tags
    public function relatedArticles($limit = 3)
    {
        return Article::where('id', '!=', $this->id)
            ->where('category', $this->category)
            ->where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->limit($limit)
            ->get();
    }

    // Accesseur pour formater les tags s'ils sont stockés comme chaîne
    public function getTagsListAttribute()
    {
        if (is_string($this->tags)) {
            return array_map('trim', explode(',', $this->tags));
        }
        return $this->tags;
    }

    // Générer automatiquement un slug unique à partir du titre
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($article) {
            if (empty($article->slug)) {
                $article->slug = Str::slug($article->title);

                // S'assurer que le slug est unique
                $count = static::where('slug', $article->slug)
                    ->where('id', '!=', $article->id)
                    ->count();

                if ($count > 0) {
                    $article->slug = $article->slug . '-' . ($count + 1);
                }
            }

            // Mettre à jour la date de modification
            $article->modified_at = now();
        });
    }

    // Scopes pour faciliter les requêtes
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                    ->where('published_at', '<=', now());
    }

    public function scopeRecent($query, $limit = 5)
    {
        return $query->published()
                    ->orderBy('published_at', 'desc')
                    ->limit($limit);
    }
}
