<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'repo_url' => 'nullable|url',
            'demo_url' => 'nullable|url',
            'screenshot' => 'nullable|image|max:2048',
            'languages' => 'required|string',
            'technologies' => 'nullable|string',
            'featured' => 'boolean',
            'completed_at' => 'nullable|date',
            'is_published' => 'boolean',
        ]);

        // Gérer l'upload de capture d'écran
        if ($request->hasFile('screenshot')) {
            $path = $request->file('screenshot')->store('projects', 'public');
            $validated['screenshot'] = Storage::url($path);
        }

        // Convertir les langages et technologies en format JSON
        $validated['languages'] = array_map('trim', explode(',', $validated['languages']));

        if (isset($validated['technologies'])) {
            $validated['technologies'] = array_map('trim', explode(',', $validated['technologies']));
        }

        Project::create($validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Projet créé avec succès.');
    }

    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'repo_url' => 'nullable|url',
            'demo_url' => 'nullable|url',
            'screenshot' => 'nullable|image|max:2048',
            'languages' => 'required|string',
            'technologies' => 'nullable|string',
            'featured' => 'boolean',
            'completed_at' => 'nullable|date',
            'is_published' => 'boolean',
        ]);

        // Gérer l'upload de capture d'écran
        if ($request->hasFile('screenshot')) {
            // Supprimer l'ancienne image si elle existe
            if ($project->screenshot) {
                $oldPath = str_replace('/storage', 'public', $project->screenshot);
                Storage::delete($oldPath);
            }

            $path = $request->file('screenshot')->store('projects', 'public');
            $validated['screenshot'] = Storage::url($path);
        }

        // Convertir les langages et technologies en format JSON
        $validated['languages'] = array_map('trim', explode(',', $validated['languages']));

        if (isset($validated['technologies'])) {
            $validated['technologies'] = array_map('trim', explode(',', $validated['technologies']));
        }

        $project->update($validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Projet mis à jour avec succès.');
    }

    public function destroy(Project $project)
    {
        // Supprimer la capture d'écran si elle existe
        if ($project->screenshot) {
            $path = str_replace('/storage', 'public', $project->screenshot);
            Storage::delete($path);
        }

        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Projet supprimé avec succès.');
    }
}
