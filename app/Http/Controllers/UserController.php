<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $students = User::where('role', 'student')
            ->withCount(['borrowings' => function ($query) {
                $query->where('status', 'borrowed');
            }])
            ->paginate(15);
        
        return view('admin.users.index', compact('students'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'student_id' => 'required|string',
        ]);

        $student = User::where('student_id', $request->student_id)
            ->where('role', 'student')
            ->first();

        if (!$student) {
            return back()->with('error', 'Student not found.');
        }

        return redirect()->route('admin.users.show', $student);
    }

    public function show(User $user)
    {
        if ($user->role !== 'student') {
            abort(404);
        }

        $borrowings = $user->borrowings()->with('book')->latest()->get();
        
        return view('admin.users.show', compact('user', 'borrowings'));
    }
}