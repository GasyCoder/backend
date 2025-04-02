<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::with('author')
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);

        return view('admin.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'description' => 'nullable|string|max:255',
            'category' => 'required|string|max:50',
            'tags' => 'nullable|string',
            'cover_image' => 'nullable|image|max:2048',
            'read_time' => 'required|integer|min:1',
            'published_at' => 'nullable|date',
            'is_published' => 'boolean',
        ]);

        // Préserver le Markdown brut (sans échappement)
        $validated['content'] = $request->input('content');
        
        // Nettoyer le Markdown pour la description (sans supprimer la syntaxe Markdown)
        if ($request->has('description')) {
            $validated['description'] = $request->input('description');
            
            // Limiter la longueur si nécessaire en respectant la syntaxe Markdown
            if (Str::length($validated['description']) > 255) {
                $validated['description'] = Str::limit($validated['description'], 252, '...');
            }
        }

        // Gérer l'upload d'image
        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('articles', 'public');
            $validated['cover_image'] = Storage::url($path);
        }

        // Convertir les tags en format JSON
        if (isset($validated['tags'])) {
            $validated['tags'] = array_map('trim', explode(',', $validated['tags']));
        }

        // Définir l'auteur
        $validated['author_id'] = auth()->id();

        // Gérer la date de publication
        if (!empty($validated['is_published']) && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        // Créer un slug basé sur le titre (à des fins d'URL)
        $validated['slug'] = Str::slug($validated['title']);

        Article::create($validated);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return view('admin.articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        // Préparer les tags pour l'affichage
        if (is_array($article->tags)) {
            $article->tags = implode(', ', $article->tags);
        }
        
        return view('admin.articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'description' => 'nullable|string|max:255',
            'category' => 'required|string|max:50',
            'tags' => 'nullable|string',
            'cover_image' => 'nullable|image|max:2048',
            'read_time' => 'required|integer|min:1',
            'published_at' => 'nullable|date',
            'is_published' => 'boolean',
        ]);

        // Préserver le Markdown brut
        $validated['content'] = $request->input('content');
        
        // Nettoyer le Markdown pour la description (sans supprimer la syntaxe Markdown)
        if ($request->has('description')) {
            $validated['description'] = $request->input('description');
            
            // Limiter la longueur si nécessaire en respectant la syntaxe Markdown
            if (Str::length($validated['description']) > 255) {
                $validated['description'] = Str::limit($validated['description'], 252, '...');
            }
        }

        // Gérer l'upload d'image
        if ($request->hasFile('cover_image')) {
            // Supprimer l'ancienne image si elle existe
            if ($article->cover_image) {
                $oldPath = str_replace('/storage', 'public', $article->cover_image);
                Storage::delete($oldPath);
            }

            $path = $request->file('cover_image')->store('articles', 'public');
            $validated['cover_image'] = Storage::url($path);
        }

        // Convertir les tags en format JSON
        if (isset($validated['tags'])) {
            $validated['tags'] = array_map('trim', explode(',', $validated['tags']));
        }

        // Gérer la date de publication
        if (!empty($validated['is_published']) && empty($article->published_at)) {
            $validated['published_at'] = now();
        }

        // Mettre à jour le slug si le titre a changé
        if ($article->title !== $validated['title']) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $article->update($validated);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        // Supprimer l'image de couverture si elle existe
        if ($article->cover_image) {
            $path = str_replace('/storage', 'public', $article->cover_image);
            Storage::delete($path);
        }

        $article->delete();

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article supprimé avec succès.');
    }
}