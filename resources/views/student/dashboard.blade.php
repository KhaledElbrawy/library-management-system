<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Current Borrowings -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Currently Borrowed Books</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @forelse($currentBorrowings as $borrowing)
                            <div class="border rounded-lg overflow-hidden hover:shadow-lg transition-shadow">
                                @if($borrowing->book->image)
                                    <img src="{{ asset('storage/' . $borrowing->book->image) }}" 
                                         alt="{{ $borrowing->book->title }}" 
                                         class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                        <span class="text-gray-400">No Image</span>
                                    </div>
                                @endif

                                <div class="p-4">
                                    <h3 class="font-semibold text-lg mb-1">{{ $borrowing->book->title }}</h3>
                                    <p class="text-gray-600 text-sm mb-2">by {{ $borrowing->book->author }}</p>
                                    <p class="text-sm mb-2">
                                        Borrowed: {{ $borrowing->borrowed_at->format('M d, Y') }} | 
                                        Due: {{ $borrowing->due_date->format('M d, Y') }}
                                    </p>

                                    @if($borrowing->isOverdue())
                                        <p class="text-sm font-bold text-red-600 mb-2">
                                            OVERDUE - Fine: ${{ $borrowing->calculateFine() }}
                                        </p>
                                    @endif

                                    {{-- Return Book Button على اليمين --}}
                                    <div class="flex justify-end gap-4 mb-2">
                                        <form action="{{ route('borrowings.return', $borrowing) }}" method="POST">
                                            @csrf
                                            <button type="submit" 
                                                    class="text-blue-500 hover:text-blue-700 text-sm font-semibold"
                                                    onclick="return confirm('Are you sure you want to return this book?')">
                                                Return Book
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 col-span-3">You have no books currently borrowed.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Borrowing History -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Borrowing History</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Book</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Author</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Borrowed Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Returned Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fine</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($borrowingHistory as $borrowing)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $borrowing->book->title }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $borrowing->book->author }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $borrowing->borrowed_at->format('Y-m-d') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $borrowing->returned_at->format('Y-m-d') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($borrowing->fine > 0)
                                                <span class="text-red-600">${{ $borrowing->fine }}</span>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">No borrowing history found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
