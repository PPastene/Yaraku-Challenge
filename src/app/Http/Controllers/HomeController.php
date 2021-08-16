<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repositories\Contracts\BookContract;
use Illuminate\Support\Facades\Redirect;
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
        return Inertia::render('Index', [
            'books' => $books
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->except('_token', 'created_at', 'updated_at');
        $this->book->addBook($request);
        return Redirect::route('index');
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
