<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repositories\Contracts\BookContract;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function __construct(BookContract $book)
    {
        $this->book = $book;
    }

    public function index()
    {
        $books = $this->book->getBooks();
        return Inertia::render('Index');
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        return $this->book->addBook($request);
    }

    public function destroy($id)
    {
        return $this->book->deleteBook($id);
    }

    public function search(Request $request)
    {
        return $this->book->searchBook($request);
    }
}
