<x-app-layout>
    <div class="max-w-5xl mx-auto p-6">

        <!-- Project Card -->
        <div class="bg-white p-6 rounded-lg shadow mb-6">
            <h2 class="text-2xl font-bold">{{ $project->title }}</h2>
            <p class="text-gray-500 mt-2">
                {{ $project->description }}
            </p>
        </div>
        @php
    $totalTasks = $project->tasks->count();
    $completedTasks = $project->tasks->where('is_completed', true)->count();
    $percentage = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;
@endphp
<div class="bg-white p-6 rounded-lg shadow mb-6">
    <div class="flex justify-between items-center mb-2">
        <h3 class="font-semibold text-gray-700">
            Progress
        </h3>
        <span class="text-sm text-gray-500">
            {{ $completedTasks }} / {{ $totalTasks }} completed
        </span>
    </div>

    <div class="w-full bg-gray-200 rounded-full h-3">
        <div class="bg-green-500 h-3 rounded-full transition-all duration-300"
             style="width: {{ $percentage }}%">
        </div>
    </div>

    <p class="text-sm text-gray-500 mt-2">
        {{ $percentage }}% complete
    </p>
</div>
        <!-- Tasks Heading -->
         
        <h3 class="text-lg font-semibold mb-3">Tasks</h3>

<form method="POST" action="{{ route('projects.tasks.store', $project) }}"
      enctype="multipart/form-data"
      class="flex gap-2 mb-4">    @csrf
    <input type="text" name="title"
        class="border rounded px-3 py-2 w-full"
        placeholder="Add a new task..."
        required>
         <input type="file"
       name="attachment"
       class="text-sm border border-gray-300 rounded-lg px-3 py-2 bg-white">  
    <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
    Add Task
</button>
</form>

<ul class="space-y-3">
    @if($project->tasks->isEmpty())
    <div class="bg-white p-6 rounded-lg shadow text-center text-gray-500">
        No tasks yet. Add your first task above 🚀
    </div>
@endif
    @foreach ($project->tasks as $task)
     <li class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-between">

    <div class="flex items-start gap-3">
         
        <!-- Checkbox -->
        <form method="POST"
              action="{{ route('projects.tasks.update', [$project, $task]) }}">
            @csrf
            @method('PUT')

            <input type="checkbox"
                   class="mt-1 rounded border-gray-300"
                   onchange="this.form.submit()"
                   {{ $task->is_completed ? 'checked' : '' }}>
        </form>

        <!-- Task Content -->
        <div>
            <p class="font-medium {{ $task->is_completed ? 'line-through text-gray-400' : 'text-gray-800' }}">
                {{ $task->title }}
            </p>

            @if ($task->attachment)
                <a href="{{ asset('storage/' . $task->attachment) }}"
                   target="_blank"
                   class="text-sm text-blue-500 hover:underline mt-1 inline-block">
                    📎 View Attachment
                </a>
            @endif
            <p class="text-xs text-gray-400 mt-1">
    Created {{ $task->created_at->diffForHumans() }}
</p>
        </div>
    </div>

    <!-- Delete Button -->
    <form method="POST"
          action="{{ route('projects.tasks.destroy', [$project, $task]) }}">
        @csrf
        @method('DELETE')

        <button class="text-red-500 text-sm hover:text-red-700">
            Delete
        </button>
    </form>

</li>


    @endforeach
</ul>
</div>
</x-app-layout>

