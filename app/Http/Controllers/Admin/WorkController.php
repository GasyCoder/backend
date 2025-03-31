<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $works = Work::orderBy('position', 'asc')->paginate(10);
        return view('admin.works.index', compact('works'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.works.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'client_name' => 'nullable|string|max:255',
            'year' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'technologies' => 'nullable|string',
            'url' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean',
            'position' => 'integer',
        ]);

        $data = $request->except('image', 'technologies');

        // Traiter les technologies
        if ($request->has('technologies')) {
            $technologies = explode(',', $request->technologies);
            $data['technologies'] = array_map('trim', $technologies);
        }

        // Traiter l'image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('works', 'public');
            $data['image'] = '/storage/' . $imagePath;
        }

        // Créer le slug
        $data['slug'] = Str::slug($request->title);

        Work::create($data);

        return redirect()->route('admin.works.index')
            ->with('success', 'Travail créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Work $work)
    {
        return view('admin.works.show', compact('work'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Work $work)
    {
        return view('admin.works.edit', compact('work'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Work $work)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'client_name' => 'nullable|string|max:255',
            'year' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'technologies' => 'nullable|string',
            'url' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean',
            'position' => 'integer',
        ]);

        $data = $request->except('image', 'technologies');

        // Traiter les technologies
        if ($request->has('technologies')) {
            $technologies = explode(',', $request->technologies);
            $data['technologies'] = array_map('trim', $technologies);
        }

        // Traiter l'image
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($work->image && Storage::disk('public')->exists(str_replace('/storage/', '', $work->image))) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $work->image));
            }

            $imagePath = $request->file('image')->store('works', 'public');
            $data['image'] = '/storage/' . $imagePath;
        }

        // Mise à jour du slug uniquement si le titre a changé
        if ($request->title !== $work->title) {
            $data['slug'] = Str::slug($request->title);
        }

        $work->update($data);

        return redirect()->route('admin.works.index')
            ->with('success', 'Travail mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Work $work)
    {
        // Supprimer l'image si elle existe
        if ($work->image && Storage::disk('public')->exists(str_replace('/storage/', '', $work->image))) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $work->image));
        }

        $work->delete();

        return redirect()->route('admin.works.index')
            ->with('success', 'Travail supprimé avec succès.');
    }
}
