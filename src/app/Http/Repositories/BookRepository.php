<?php

namespace App\Http\Repositories;

use Illuminate\Http\Request;
use App\Http\Repositories\Contracts\BookContract;
use App\Models\Book;

class BookRepository implements BookContract
{
    public function getBooks($data)
    {
        return Book::where('title', 'LIKE', '%'.$data->title.'%')
                    ->where('author', 'LIKE', '%'.$data->author.'%')
                    ->orderBy('created_at', 'DESC')
                    ->get();
    }

    public function addBook($data)
    {
        $book = new Book;
        $book->title = $data['title'];
        $book->author = $data['author'];

        return $book->save();
    }

    public function editBook($data)
    {
        $book = Book::where('id', $data['id'])->first();
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
