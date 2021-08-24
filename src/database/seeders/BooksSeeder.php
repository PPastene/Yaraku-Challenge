<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Book::create([
            'title' => 'Jurassic Park',
            'author' => 'Michael Crichton'
        ]);
        Book::create([
            'title' => 'The Shining',
            'author' => 'Stephen King'
        ]);
        Book::create([
            'title' => 'The Iliad',
            'author' => 'Homer'
        ]);
        Book::create([
            'title' => "Harry Potter and The Philosopher's Stone",
            'author' => 'J. K. Rowling'
        ]);
        Book::create([
            'title' => "Harry Potter and The Philosopher's Stone",
            'author' => 'J. K. Rowling'
        ]);
    }
}
