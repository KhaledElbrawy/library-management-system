<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [
                'title' => 'Introduction to Laravel',
                'author' => 'Taylor Otwell',
                'isbn' => '978-1234567890',
                'publisher' => 'Laravel Press',
                'publication_year' => 2024,
                'category' => 'Programming',
                'quantity' => 5,
                'available_quantity' => 4,
                'description' => 'A comprehensive guide to Laravel framework',
            ],
            [
                'title' => 'Clean Code',
                'author' => 'Robert C. Martin',
                'isbn' => '978-0132350884',
                'publisher' => 'Prentice Hall',
                'publication_year' => 2008,
                'category' => 'Programming',
                'quantity' => 3,
                'available_quantity' => 3,
                'description' => 'A Handbook of Agile Software Craftsmanship',
            ],
            [
                'title' => 'Design Patterns',
                'author' => 'Gang of Four',
                'isbn' => '978-0201633610',
                'publisher' => 'Addison-Wesley',
                'publication_year' => 1994,
                'category' => 'Software Engineering',
                'quantity' => 4,
                'available_quantity' => 3,
                'description' => 'Elements of Reusable Object-Oriented Software',
            ],
            [
                'title' => 'The Pragmatic Programmer',
                'author' => 'David Thomas, Andrew Hunt',
                'isbn' => '978-0135957059',
                'publisher' => 'Addison-Wesley',
                'publication_year' => 2019,
                'category' => 'Programming',
                'quantity' => 6,
                'available_quantity' => 5,
                'description' => 'Your Journey to Mastery',
            ],
            [
                'title' => 'Database Systems',
                'author' => 'C.J. Date',
                'isbn' => '978-0321197844',
                'publisher' => 'Pearson',
                'publication_year' => 2003,
                'category' => 'Database',
                'quantity' => 2,
                'available_quantity' => 2,
                'description' => 'A Practical Approach to Design',
            ],
            [
                'title' => 'JavaScript: The Good Parts',
                'author' => 'Douglas Crockford',
                'isbn' => '978-0596517748',
                'publisher' => 'O\'Reilly Media',
                'publication_year' => 2008,
                'category' => 'Programming',
                'quantity' => 4,
                'available_quantity' => 4,
                'description' => 'Unearthing the Excellence in JavaScript',
            ],
            [
                'title' => 'You Don\'t Know JS',
                'author' => 'Kyle Simpson',
                'isbn' => '978-1491904244',
                'publisher' => 'O\'Reilly Media',
                'publication_year' => 2015,
                'category' => 'Programming',
                'quantity' => 3,
                'available_quantity' => 3,
                'description' => 'Up & Going',
            ],
            [
                'title' => 'System Design Interview',
                'author' => 'Alex Xu',
                'isbn' => '978-1736049112',
                'publisher' => 'ByteByteGo',
                'publication_year' => 2020,
                'category' => 'System Design',
                'quantity' => 5,
                'available_quantity' => 5,
                'description' => 'An Insider\'s Guide',
            ],
            [
                'title' => 'Introduction to Algorithms',
                'author' => 'Thomas H. Cormen',
                'isbn' => '978-0262046305',
                'publisher' => 'MIT Press',
                'publication_year' => 2009,
                'category' => 'Algorithms',
                'quantity' => 3,
                'available_quantity' => 3,
                'description' => 'Third Edition',
            ],
            [
                'title' => 'Head First Design Patterns',
                'author' => 'Eric Freeman, Elisabeth Robson',
                'isbn' => '978-0596007126',
                'publisher' => 'O\'Reilly Media',
                'publication_year' => 2004,
                'category' => 'Software Engineering',
                'quantity' => 4,
                'available_quantity' => 4,
                'description' => 'A Brain-Friendly Guide',
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }

        
    }
}
