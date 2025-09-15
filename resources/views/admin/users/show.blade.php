<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $user->name }} - Borrowings
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Borrowed Books</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @forelse($borrowings as $borrowing)
                        <div class="border rounded-lg p-4">
                            <h4 class="font-semibold">{{ $borrowing->book->title }}</h4>
                            <p class="text-sm text-gray-600">by {{ $borrowing->book->author }}</p>
                            <p class="text-sm mt-2">Borrowed: {{ $borrowing->borrowed_at->format('M d, Y') }}</p>
                            @if($borrowing->isOverdue())
                                <p class="text-sm font-bold text-red-600 mt-2">OVERDUE - Fine: ${{ $borrowing->calculateFine() }}</p>
                            @endif
                        </div>
                    @empty
                        <p class="text-gray-500 col-span-3">No borrowed books.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
