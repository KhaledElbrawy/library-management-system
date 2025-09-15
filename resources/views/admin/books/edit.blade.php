<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Book') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('admin.books.update', $book) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="title" :value="__('Title')" />
                                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $book->title)" required />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>
                            
                            <div>
                                <x-input-label for="author" :value="__('Author')" />
                                <x-text-input id="author" class="block mt-1 w-full" type="text" name="author" :value="old('author', $book->author)" required />
                                <x-input-error :messages="$errors->get('author')" class="mt-2" />
                            </div>
                            
                            <div>
                                <x-input-label for="isbn" :value="__('ISBN')" />
                                <x-text-input id="isbn" class="block mt-1 w-full" type="text" name="isbn" :value="old('isbn', $book->isbn)" required />
                                <x-input-error :messages="$errors->get('isbn')" class="mt-2" />
                            </div>
                            
                            <div>
                                <x-input-label for="category" :value="__('Category')" />
                                <x-text-input id="category" class="block mt-1 w-full" type="text" name="category" :value="old('category', $book->category)" required />
                                <x-input-error :messages="$errors->get('category')" class="mt-2" />
                            </div>
                            
                            <div>
                                <x-input-label for="publisher" :value="__('Publisher')" />
                                <x-text-input id="publisher" class="block mt-1 w-full" type="text" name="publisher" :value="old('publisher', $book->publisher)" />
                                <x-input-error :messages="$errors->get('publisher')" class="mt-2" />
                            </div>
                            
                            <div>
                                <x-input-label for="publication_year" :value="__('Publication Year')" />
                                <x-text-input id="publication_year" class="block mt-1 w-full" type="number" name="publication_year" :value="old('publication_year', $book->publication_year)" min="1900" max="{{ date('Y') }}" />
                                <x-input-error :messages="$errors->get('publication_year')" class="mt-2" />
                            </div>
                            
                            <div>
                                <x-input-label for="quantity" :value="__('Quantity')" />
                                <x-text-input id="quantity" class="block mt-1 w-full" type="number" name="quantity" :value="old('quantity', $book->quantity)" min="1" required />
                                <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                            </div>
                            
                            <div>
                                <x-input-label for="image" :value="__('Book Cover Image')" />
                                @if($book->image)
                                    <img src="{{ asset('storage/' . $book->image) }}" alt="Current cover" class="w-32 h-32 object-cover mb-2">
                                @endif
                                <input id="image" class="block mt-1 w-full" type="file" name="image" accept="image/*" />
                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                            </div>
                        </div>
                        
                        <div class="mt-6">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" rows="4" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">{{ old('description', $book->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                        
                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('admin.books.index') }}" class="mr-3 text-gray-600 hover:text-gray-900">Cancel</a>
                            <x-primary-button>
                                {{ __('Update Book') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>