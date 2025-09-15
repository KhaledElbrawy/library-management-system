<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        if ($user->isAdmin()) {
            $totalBooks = Book::count();
            $totalUsers = User::where('role', 'student')->count();
            $borrowedBooks = Borrowing::where('status', 'borrowed')->count();
            $overdueBooks = Borrowing::where('status', 'borrowed')
                ->where('due_date', '<', now())
                ->count();
            
            $recentBorrowings = Borrowing::with(['user', 'book'])
                ->latest('borrowed_at')
                ->take(5)
                ->get();
            
            return view('admin.dashboard', compact(
                'totalBooks', 
                'totalUsers', 
                'borrowedBooks', 
                'overdueBooks',
                'recentBorrowings'
            ));
        }
        
        
        $borrowings = Borrowing::with('book')
            ->where('user_id', $user->id)
            ->latest('borrowed_at')
            ->get();
        
        $currentBorrowings = $borrowings->where('status', 'borrowed');
        $borrowingHistory = $borrowings->where('status', 'returned');
        
        return view('student.dashboard', compact('currentBorrowings', 'borrowingHistory'));
    }
}