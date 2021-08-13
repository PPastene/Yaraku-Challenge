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

    public function addBook($data)
    {
        $book = new Book;
        $book->title = $data['title'];
        $book->author = $data['author'];

        return $book->save();
    }

    public function deleteBook($id)
    {
        $book = Book::find($id);

        return $book->delete();
    }
}
