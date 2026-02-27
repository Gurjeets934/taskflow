<x-app-layout>
    <div class="max-w-5xl mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4">Create Project</h2>

        <form method="POST" action="{{ route('projects.store') }}">
            @csrf

            <input type="text" name="title" placeholder="Project Title"
                   class="border p-2 w-full mb-3" required>

            <textarea name="description" placeholder="Description"
                      class="border p-2 w-full mb-3"></textarea>

            <button class="bg-green-500 text-white px-4 py-2 rounded">
                Create
            </button>
        </form>
    </div>
</x-app-layout>