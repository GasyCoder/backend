<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::published()
                          ->orderBy('published_at', 'desc')
                          ->get();
        return response()->json($articles);
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        // Enrichir la réponse avec des informations supplémentaires
        $response = [
            'id' => $article->id,
            'title' => $article->title,
            'slug' => $article->slug,
            'content' => $article->content,
            'description' => $article->description,
            'category' => $article->category,
            'tags' => $article->tags,
            'cover_image' => $article->cover_image,
            'published_at' => $article->published_at,
            'modified_at' => $article->modified_at,
            'read_time' => $article->read_time,
            'author' => $article->author ? [
                'name' => $article->author->name,
                'avatar' => $article->author->avatar ?? null,
                'title' => $article->author->title ?? null,
            ] : null,
            'related_articles' => $article->relatedArticles()->map(function($related) {
                return [
                    'title' => $related->title,
                    'slug' => $related->slug,
                    'category' => $related->category,
                ];
            }),
        ];

        return response()->json($response);
    }
}
