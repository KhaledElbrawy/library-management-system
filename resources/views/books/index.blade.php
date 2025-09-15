<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Library Books') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Success & Error Messages --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @foreach($books as $book)
                            <div class="border rounded-lg overflow-hidden hover:shadow-lg transition-shadow">
                                @if($book->image)
                                    <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                        <span class="text-gray-400">No Image</span>
                                    </div>
                                @endif
                                <div class="p-4">
                                    <h3 class="font-semibold text-lg mb-1">{{ $book->title }}</h3>
                                    <p class="text-gray-600 text-sm mb-2">by {{ $book->author }}</p>
                                    <p class="text-gray-500 text-xs mb-3">{{ $book->category }}</p>
                                    
                                    {{-- Buttons on the right with space --}}
                                    <div class="flex justify-end gap-4 mb-2">
                                        @if($book->available_quantity > 0)
                                            <form action="{{ route('books.borrow', $book) }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                        class="text-blue-500 hover:text-blue-700 text-sm font-semibold"
                                                        onclick="return confirm('Are you sure you want to borrow this book?')">
                                                    Borrow Book
                                                </button>
                                            </form>
                                        @endif
                                        <a href="{{ route('books.show', $book) }}" class="text-blue-500 hover:text-blue-700 text-sm">
                                            View Details
                                        </a>
                                    </div>

                                    {{-- Availability --}}
                                    <div class="text-sm">
                                        @if($book->available_quantity > 0)
                                            <span class="text-green-600">Available ({{ $book->available_quantity }})</span>
                                        @else
                                            <span class="text-red-600">Not Available</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    @if($books->isEmpty())
                        <div class="text-center py-8">
                            <p class="text-gray-500">No books available at the moment.</p>
                        </div>
                    @endif
                    
                    <div class="mt-6">
                        {{ $books->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
