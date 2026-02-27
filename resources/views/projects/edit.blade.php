<x-app-layout>
    <div class="max-w-5xl mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4">Edit Project</h2>

        <form method="POST" action="{{ route('projects.update', $project) }}">
            @csrf
            @method('PUT')

            <input type="text" name="title" value="{{ $project->title }}"
                   class="border p-2 w-full mb-3" required>

            <textarea name="description"
                      class="border p-2 w-full mb-3">{{ $project->description }}</textarea>

            <select name="status" class="border p-2 w-full mb-3">
                <option value="pending" {{ $project->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="completed" {{ $project->status == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>

            <button class="bg-blue-500 text-white px-4 py-2 rounded">
                Update
            </button>
        </form>
    </div>
</x-app-layout>