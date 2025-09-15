<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Borrowing Details') }}
            </h2>
            <a href="{{ route('admin.borrowings.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                ← Back to All Borrowings
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    
                    <div class="mb-6">
                        @if($borrowing->returned_at)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Returned
                            </span>
                        @elseif($borrowing->due_date && $borrowing->due_date->isPast())
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                                Overdue ({{ abs($borrowing->due_date->diffInDays()) }} days)
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Currently Borrowed
                            </span>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        
                        
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6">
                            <h3 class="text-lg font-semibold mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Student Information
                            </h3>
                            
                            <div class="space-y-3">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-12 w-12">
                                        <div class="h-12 w-12 rounded-full bg-indigo-500 flex items-center justify-center">
                                            <span class="text-lg font-medium text-white">
                                                {{ strtoupper(substr($borrowing->user->name, 0, 2)) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-lg font-medium">{{ $borrowing->user->name }}</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $borrowing->user->email }}</div>
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <span class="font-medium">Student ID:</span>
                                        <div>{{ $borrowing->user->student_id ?? 'N/A' }}</div>
                                    </div>
                                    <div>
                                        <span class="font-medium">Phone:</span>
                                        <div>{{ $borrowing->user->phone ?? 'N/A' }}</div>
                                    </div>
                                </div>
                                
                                @if($borrowing->user->address)
                                    <div class="text-sm">
                                        <span class="font-medium">Address:</span>
                                        <div>{{ $borrowing->user->address }}</div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6">
                            <h3 class="text-lg font-semibold mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                                Book Information
                            </h3>
                            
                            <div class="space-y-3">
                                <div>
                                    <h4 class="text-lg font-medium">{{ $borrowing->book->title }}</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">by {{ $borrowing->book->author }}</p>
                                </div>
                                
                                <div class="grid grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <span class="font-medium">ISBN:</span>
                                        <div>{{ $borrowing->book->isbn ?? 'N/A' }}</div>
                                    </div>
                                    <div>
                                        <span class="font-medium">Category:</span>
                                        <div>{{ $borrowing->book->category ?? 'N/A' }}</div>
                                    </div>
                                    <div>
                                        <span class="font-medium">Publisher:</span>
                                        <div>{{ $borrowing->book->publisher ?? 'N/A' }}</div>
                                    </div>
                                    <div>
                                        <span class="font-medium">Year:</span>
                                        <div>{{ $borrowing->book->year ?? 'N/A' }}</div>
                                    </div>
                                    <div>
                                        <span class="font-medium">Location:</span>
                                        <div>{{ $borrowing->book->location ?? 'N/A' }}</div>
                                    </div>
                                    <div>
                                        <span class="font-medium">Available:</span>
                                        <div>{{ $borrowing->book->available_quantity }} / {{ $borrowing->book->quantity }}</div>
                                    </div>
                                </div>
                                
                                @if($borrowing->book->description)
                                    <div class="text-sm">
                                        <span class="font-medium">Description:</span>
                                        <div class="mt-1">{{ $borrowing->book->description }}</div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    
                    <div class="mt-8 bg-gray-50 dark:bg-gray-700 rounded-lg p-6">
                        <h3 class="text-lg font-semibold mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            Borrowing Timeline
                        </h3>

                        <div class="space-y-4">
                            @if($borrowing->borrowed_at)
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-4 h-4 mt-1 bg-blue-500 rounded-full"></div>
                                <div class="ml-4">
                                    <div class="font-medium">Book Borrowed</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-400">
                                        {{ $borrowing->borrowed_at->format('F d, Y \a\t g:i A') }}
                                        <span class="text-xs text-gray-500">({{ $borrowing->borrowed_at->diffForHumans() }})</span>
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if($borrowing->due_date)
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-4 h-4 mt-1 {{ $borrowing->due_date->isPast() && !$borrowing->returned_at ? 'bg-red-500' : 'bg-yellow-500' }} rounded-full"></div>
                                <div class="ml-4">
                                    <div class="font-medium">Due Date</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-400">
                                        {{ $borrowing->due_date->format('F d, Y \a\t g:i A') }}
                                        @if(!$borrowing->returned_at)
                                            @if($borrowing->due_date->isPast())
                                                <span class="text-red-500 font-medium">({{ abs($borrowing->due_date->diffInDays()) }} days overdue)</span>
                                            @else
                                                <span class="text-green-500">({{ $borrowing->due_date->diffInDays() }} days remaining)</span>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if($borrowing->returned_at)
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-4 h-4 mt-1 bg-green-500 rounded-full"></div>
                                <div class="ml-4">
                                    <div class="font-medium">Book Returned</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-400">
                                        {{ $borrowing->returned_at->format('F d, Y \a\t g:i A') }}
                                        <span class="text-xs text-gray-500">({{ $borrowing->returned_at->diffForHumans() }})</span>
                                        @if($borrowing->due_date)
                                            @if($borrowing->returned_at->gt($borrowing->due_date))
                                                <span class="text-red-500 font-medium ml-2">(Late return)</span>
                                            @else
                                                <span class="text-green-500 font-medium ml-2">(On time)</span>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    
                    @if(!$borrowing->returned_at)
                        <div class="mt-8 flex flex-wrap gap-4">
                            <form method="POST" action="{{ route('admin.borrowings.return', $borrowing->id) }}" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                        onclick="return confirm('Mark this book as returned?')"
                                        class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Mark as Returned
                                </button>
                            </form>

                            @if($borrowing->due_date && $borrowing->due_date->isPast())
                                <form method="POST" action="{{ route('admin.borrowings.remind', $borrowing->id) }}" class="inline">
                                    @csrf
                                    <button type="submit" 
                                            class="inline-flex items-center px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-orange-700 focus:bg-orange-700 active:bg-orange-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4 16l4-4m0 0l4 4m-4-4v12"></path>
                                        </svg>
                                        Send Reminder
                                    </button>
                                </form>
                            @endif
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
