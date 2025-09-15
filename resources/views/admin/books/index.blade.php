<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">
            {{ __('Manage Books') }}
        </h2>
    </x-slot>

    <div class="py-2 px-6">
        <a href="{{ route('admin.books.create') }}"
           class="inline-block bg-blue-600 text-white font-semibold px-6 py-2 rounded shadow hover:bg-blue-700 transition">
            + Add New Book
        </a>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase">Title</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase">Author</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase">ISBN</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase">Category</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase">Available/Total</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($books as $book)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-black">{{ $book->title }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-black">{{ $book->author }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-black">{{ $book->isbn }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-black">{{ $book->category }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-black">
                                            {{ $book->available_quantity }}/{{ $book->quantity }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                            <a href="{{ route('admin.books.edit', $book) }}"
                                               class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                                            <form action="{{ route('admin.books.destroy', $book) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="text-red-600 hover:text-red-900"
                                                        onclick="return confirm('Are you sure?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        {{ $books->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
