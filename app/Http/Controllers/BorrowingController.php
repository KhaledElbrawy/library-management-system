<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    public function borrow(Book $book)
    {
        if (!$book->isAvailable()) {
            return back()->with('error', 'This book is not available for borrowing.');
        }

        $existingBorrowing = Borrowing::where('user_id', auth()->id())
            ->where('book_id', $book->id)
            ->where('status', 'borrowed')
            ->exists();

        if ($existingBorrowing) {
            return back()->with('error', 'You have already borrowed this book.');
        }

        Borrowing::create([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
            'borrowed_at' => now(),
            'due_date' => Carbon::now()->addDays(14),
            'status' => 'borrowed',
        ]);

        $book->decrement('available_quantity');

        return redirect()->route('dashboard')
            ->with('success', 'Book borrowed successfully! Due date: ' . Carbon::now()->addDays(14)->format('Y-m-d'));
    }

    public function return(Borrowing $borrowing)
    {
        if ($borrowing->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $borrowing->update([
            'returned_at' => now(),
            'status' => 'returned',
            'fine' => $borrowing->calculateFine(),
        ]);

        $borrowing->book->increment('available_quantity');

        return back()->with('success', 'Book returned successfully!');
    }
    
    public function show(Borrowing $borrowing)
    {
        return view('admin.borrowings.show', compact('borrowing'));
    }


    public function adminIndex()
    {
        $borrowings = Borrowing::with(['user', 'book'])
            ->latest('borrowed_at')
            ->paginate(15);

        return view('admin.borrowings.index', compact('borrowings'));
    }
    public function destroy(Borrowing $borrowing)
    {
        
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        
        if ($borrowing->status === 'borrowed') {
            $borrowing->book->increment('available_quantity');
        }

        $borrowing->delete();

        return redirect()->route('admin.borrowings.index')
            ->with('success', 'Borrowing record deleted successfully.');
    }
}
