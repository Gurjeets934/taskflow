<x-app-layout>
   <div class="max-w-5xl mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6">Project Dashboard</h2>

    <div class="grid grid-cols-3 gap-6">

        <div class="bg-blue-100 p-4 rounded shadow">
            <h3 class="text-lg font-semibold">Total Projects</h3>
            <p class="text-2xl">{{ $total }}</p>
        </div>

        <div class="bg-green-100 p-4 rounded shadow">
            <h3 class="text-lg font-semibold">Completed</h3>
            <p class="text-2xl">{{ $completed }}</p>
        </div>

        <div class="bg-yellow-100 p-4 rounded shadow">
            <h3 class="text-lg font-semibold">Pending</h3>
            <p class="text-2xl">{{ $pending }}</p>
        </div>

    </div>
    <!-- Overall Task Progress -->
<div class="bg-white p-6 rounded-lg shadow mt-8">
    <div class="flex justify-between mb-2">
        <span class="font-semibold">Overall Task Progress</span>
        <span class="text-sm text-gray-500">
            {{ $percentage }}%
        </span>
    </div>

    <div class="w-full bg-gray-200 rounded-full h-4">
        <div class="bg-green-500 h-4 rounded-full transition-all"
             style="width: {{ $percentage }}%">
        </div>
    </div>

    <p class="text-sm text-gray-500 mt-2">
        {{ $completedTasks }} / {{ $totalTasks }} tasks completed
    </p>
</div>
<div class="bg-white p-6 rounded-lg shadow mt-8">
    <h3 class="font-semibold mb-4">Recent Projects</h3>

    @foreach(Auth::user()->projects()->latest()->take(5)->get() as $project)
        <div class="flex justify-between py-2 border-b last:border-none">
            <span>{{ $project->name }}</span>
            <a href="{{ route('projects.show', $project) }}"
               class="text-blue-500 text-sm hover:underline">
                View
            </a>
        </div>
    @endforeach
</div>
</div>
</x-app-layout>
