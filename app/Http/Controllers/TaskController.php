<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Request $request, Project $project)
    {
         $request->validate([
        'title' => 'required|string|max:255',
        'attachment' => 'nullable|file|max:2048',
    ]);

    $path = null;

    if ($request->hasFile('attachment')) {
        $path = $request->file('attachment')->store('attachments', 'public');
    }

    $project->tasks()->create([
        'title' => $request->title,
        'attachment' => $path,
    ]);


        return redirect()
            ->route('projects.show', $project)
            ->with([
                'message' => 'Task created successfully.',
                'type' => 'success'
            ]);
    }

    public function destroy(Project $project, Task $task)
    {
        $task->delete();

        return redirect()
            ->route('projects.show', $project)
            ->with([
                'message' => 'Task deleted successfully.',
                'type' => 'danger'
            ]);
    }

    public function update(Request $request, Project $project, Task $task)
    {
        $task->update([
            'is_completed' => !$task->is_completed
        ]);

        return redirect()->route('projects.show', $project);
    }
}
