<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            @if($book->image)
                                <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" class="w-full rounded-lg">
                            @else
                                <div class="w-full h-96 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <span class="text-gray-400">No Image Available</span>
                                </div>
                            @endif
                        </div>
                        
                        <div>
                            <h1 class="text-3xl font-bold mb-2">{{ $book->title }}</h1>
                            <p class="text-xl text-gray-600 mb-4">by {{ $book->author }}</p>
                            
                            <div class="space-y-2 mb-6">
                                <p><span class="font-semibold">ISBN:</span> {{ $book->isbn }}</p>
                                <p><span class="font-semibold">Category:</span> {{ $book->category }}</p>
                                <p><span class="font-semibold">Publisher:</span> {{ $book->publisher ?? 'N/A' }}</p>
                                <p><span class="font-semibold">Publication Year:</span> {{ $book->publication_year ?? 'N/A' }}</p>
                                <p><span class="font-semibold">Total Copies:</span> {{ $book->quantity }}</p>
                                <p><span class="font-semibold">Available Copies:</span> 
                                    <span class="{{ $book->available_quantity > 0 ? 'text-green-600' : 'text-red-600' }} font-bold">
                                        {{ $book->available_quantity }}
                                    </span>
                                </p>
                            </div>
                            
                            @if($book->description)
                                <div class="mb-6">
                                    <h3 class="font-semibold mb-2">Description</h3>
                                    <p class="text-gray-600">{{ $book->description }}</p>
                                </div>
                            @endif
                            
                            @if(auth()->user()->isStudent() && $book->isAvailable())
                                <form action="{{ route('books.borrow', $book) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600">
                                        Borrow This Book
                                    </button>
                                </form>
                            @elseif(!$book->isAvailable())
                                <button disabled class="bg-gray-400 text-white px-6 py-3 rounded-lg cursor-not-allowed">
                                    Currently Unavailable
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>