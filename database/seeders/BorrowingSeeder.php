<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Borrowing;

class BorrowingSeeder extends Seeder
{
    public function run(): void
    {
        Borrowing::create([
            'user_id' => 2, 
            'book_id' => 1,
            'borrowed_at' => now(),
            'due_date' => now()->addDays(14),
            'status' => 'borrowed',
        ]);

        Borrowing::create([
            'user_id' => 3, 
            'book_id' => 3,
            'borrowed_at' => now()->subDays(7),
            'due_date' => now()->addDays(7),
            'status' => 'borrowed',
        ]);

        Borrowing::create([
            'user_id' => 2, 
            'book_id' => 4,
            'borrowed_at' => now()->subDays(20),
            'due_date' => now()->subDays(6),
            'returned_at' => now()->subDays(8),
            'status' => 'returned',
        ]);
        

    }
}
