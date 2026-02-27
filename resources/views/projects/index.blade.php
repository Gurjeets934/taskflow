<x-app-layout>
    
   <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

    <!-- Left: New Project -->
    <a href="{{ route('projects.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
        + New Project
    </a>

    <!-- Right: Filters + Search -->
    <div class="flex flex-col md:flex-row items-start md:items-center gap-4">

        <!-- Status Filters -->
        <div class="flex gap-2">
            <a href="{{ route('projects.index') }}"
               class="px-3 py-2 rounded-md text-sm {{ request('status') == null ? 'bg-blue-600 text-white' : 'bg-gray-200' }}">
                All
            </a>

            <a href="{{ route('projects.index', ['status' => 'pending']) }}"
               class="px-3 py-2 rounded-md text-sm {{ request('status') == 'pending' ? 'bg-yellow-500 text-white' : 'bg-gray-200' }}">
                Pending
            </a>

            <a href="{{ route('projects.index', ['status' => 'completed']) }}"
               class="px-3 py-2 rounded-md text-sm {{ request('status') == 'completed' ? 'bg-green-600 text-white' : 'bg-gray-200' }}">
                Completed
            </a>
        </div>

        <!-- Search -->
        <form method="GET" action="{{ route('projects.index') }}" class="flex">
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Search projects..."
                   class="border rounded-l-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">

            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded-r-md hover:bg-blue-700">
                Search
            </button>
        </form>

    </div>
</div>
        <div class="mt-4">
            @foreach($projects as $project)
                <div class="bg-white shadow-md p-5 mb-4 rounded-lg border">
                    <a href="{{ route('projects.show', $project) }}"
   class="text-blue-600 font-semibold hover:underline">
    {{ $project->title }}
</a>
                    <p>{{ $project->description }}</p>
                    <span class="px-2 py-1 text-sm rounded 
    {{ $project->status === 'completed' ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800' }}">
    {{ ucfirst($project->status) }}
</span>

                    <div class="mt-2">
                        <a href="{{ route('projects.edit', $project) }}" class="text-blue-500">Edit</a>

                        <form action="{{ route('projects.destroy', $project) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500 ml-2">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
               <div class="mt-4">
    {{ $projects->links() }}
</div>
        </div>
    </div>
 
</x-app-layout>