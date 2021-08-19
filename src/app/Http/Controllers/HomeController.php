<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repositories\Contracts\BookContract;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use App\Exports\BooksExport;
use Maatwebsite\Excel\Facades\Excel;

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

    public function update(Request $request)
    {
        $data = $request->except('_token');
        $this->book->editBook($data);
        return Redirect::route('index');
    }

    public function destroy($id)
    {
        $this->book->deleteBook($id);
        return Redirect::route('index');
    }

    public function search(Request $request)
    {
        return $this->book->searchBook($request);
    }

    public function export(Request $request)
    {
        $excel = BooksExport::export($request);

        return redirect()->route("index")->with("success", [
            "excel" => "download/$excel"
        ]);
    }
}
