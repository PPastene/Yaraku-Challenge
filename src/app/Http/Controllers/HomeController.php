<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repositories\Contracts\BookContract;
use App\Http\Repositories\Contracts\ExportContract;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use App\Exports\BooksExport;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    public function __construct(BookContract $book, ExportContract $export)
    {
        $this->book = $book;
        $this->export = $export;
    }

    public function index(Request $request)
    {
        return Inertia::render('Index', [
            'books' => $this->book->getBooks($request)
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->except('_token', 'created_at', 'updated_at');
        $this->book->addBook($request);

        return redirect()->route('index')->with('success', 'Book Created');
    }

    public function update(Request $request)
    {
        $data = $request->except('_token');
        $this->book->editBook($data);

        return redirect()->route('index')->with('success', 'Book Edited');
    }

    public function destroy($id)
    {
        $this->book->deleteBook($id);

        return redirect()->route('index')->with('success', 'Book Deleted');
    }

    public function download($file)
    {
        if (!$file) {
            return redirect()->route("index");
        }

        $path = storage_path("app/public/$file");

        if (!file_exists($path)) {
            return redirect()->route("index");
        }

        return response()->download($path, $file, [
            'Content-Disposition' => 'inline; filename="' . $file . '"'
        ]);
    }

    public function export(Request $request, $type, $format)
    {
        $file = $this->export->export($type, $format);

        return redirect()->route('index')->with('success', [
            'export' => "download/$file"
        ]);
    }
}
