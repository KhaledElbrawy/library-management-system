<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Students Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <form action="{{ route('admin.users.search') }}" method="POST" class="flex gap-4">
                        @csrf
                        <input type="text" name="student_id" placeholder="Search student by ID..."
                               class="border rounded px-3 py-2 w-full">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                            Search
                        </button>
                    </form>
                </div>
            </div>

            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-gray-500 text-sm">Total Books</div>
                        <div class="text-3xl font-bold text-gray-800">{{ $totalBooks }}</div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-gray-500 text-sm">Total Students</div>
                        <div class="text-3xl font-bold text-gray-800">{{ $totalUsers }}</div>
                    </div>
                </div>
            </div>

            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Students List</h3>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Borrowed Books</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($students as $student)
                                    <tr>
                                        <td class="px-6 py-4">{{ $student->name }}</td>
                                        <td class="px-6 py-4">{{ $student->email }}</td>
                                        <td class="px-6 py-4">{{ $student->borrowings_count }}</td>
                                        <td class="px-6 py-4">
                                            <a href="{{ route('admin.users.show', $student->id) }}" 
                                               class="text-blue-600 hover:underline">View</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">No students found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    
                    <div class="mt-4">
                        {{ $students->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
