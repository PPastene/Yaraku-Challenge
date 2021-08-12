<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repositories\IBookRepository;

class BookController extends Controller
{
    public function __construct(IBookRepository $book)
    {
        $this->book = $book;
    }

    public function index()
    {
        return $this->book->getBooks();
    }

    public function create()
    {
        return view('book');
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        return $this->book->addBook($request);
    }
}
