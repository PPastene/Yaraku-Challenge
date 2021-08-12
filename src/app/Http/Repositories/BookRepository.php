<?php

namespace App\Http\Repositories;

use Illuminate\Http\Request;
use App\Http\Repositories\IBookRepository;
use App\Models\Book;

class BookRepository implements IBookRepository
{
    public function getBooks()
    {
        return Book::all();
    }
}
