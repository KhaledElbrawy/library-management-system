<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    
    public function index()
    {
        $books = Book::latest()->paginate(12);
        return view('books.index', compact('books'));
    }

    
    public function create()
    {
        return view('admin.books.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'required|string|unique:books',
            'description' => 'nullable|string',
            'category' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'publisher' => 'nullable|string|max:255',
            'publication_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('books', 'public');
        }

        $validated['available_quantity'] = $validated['quantity'];

        Book::create($validated);

        return redirect()->route('admin.books.index')->with('success', 'Book added successfully!');
    }

    
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    
    public function edit(Book $book)
    {
        return view('admin.books.edit', compact('book'));
    }

    
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'required|string|unique:books,isbn,' . $book->id,
            'description' => 'nullable|string',
            'category' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'publisher' => 'nullable|string|max:255',
            'publication_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'image' => 'nullable|image|max:2048',
        ]);

        
        if ($request->hasFile('image')) {
            if ($book->image) {
                Storage::disk('public')->delete($book->image);
            }
            $validated['image'] = $request->file('image')->store('books', 'public');
        }

        
        $quantityDiff = $validated['quantity'] - $book->quantity;
        $validated['available_quantity'] = $book->available_quantity + $quantityDiff;

        $book->update($validated);

        return redirect()->route('admin.books.index')->with('success', 'Book updated successfully!');
    }

    
    public function destroy(Book $book)
    {
        if ($book->image) {
            Storage::disk('public')->delete($book->image);
        }

        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'Book deleted successfully!');
    }

    
    public function adminIndex()
    {
        $books = Book::withCount(['borrowings' => function ($query) {
            $query->where('status', 'borrowed');
        }])->latest()->paginate(10);

        return view('admin.books.index', compact('books'));
    }
}
