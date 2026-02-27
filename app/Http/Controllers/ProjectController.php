<?php

namespace App\Http\Controllers;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
   

   public function index(Request $request)
{
   $query = Auth::user()->projects()->latest();

    // Search
    if ($request->search) {
        $query->where('title', 'like', '%' . $request->search . '%');
    }

    // Status filter
    if ($request->status && in_array($request->status, ['pending', 'completed'])) {
        $query->where('status', $request->status);
    }

    $projects = $query->paginate(5)->withQueryString();

    return view('projects.index', compact('projects'));
}

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Auth::user()->projects()->create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('projects.index')->with([
        'message' => 'Project created successfully.',
        'type' => 'success'
    ]);
    }

    public function edit(Project $project)
    {
        $this->authorizeProject($project);
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $this->authorizeProject($project);

        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $project->update($request->only('title', 'description', 'status'));

        return redirect()->route('projects.index')->with([
        'message' => 'Project updated successfully.',
        'type' => 'info'
    ]);
    }

    public function destroy(Project $project)
    {
        $this->authorizeProject($project);
        $project->delete();

        return redirect()->route('projects.index')->with([
        'message' => 'Project deleted successfully.',
        'type' => 'danger'
    ]);
    }
    
    public function show(Project $project)
{
    return view('projects.show', compact('project'));
} 

    private function authorizeProject(Project $project)
    {
        if ($project->user_id !== Auth::id()) {
            abort(403);
        }
    }
}