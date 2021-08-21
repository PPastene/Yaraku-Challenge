<?php

namespace App\Http\Repositories;

use Illuminate\Http\Request;
use App\Http\Repositories\Contracts\ExportContract;
use App\Exports\BooksExport;
use App\Models\Book;

class ExportRepository implements ExportContract
{
    public function export($type, $format)
    {
        switch($type)
        {
            case 'books':
                $items = Book::get('title');
                break;

            case 'authors':
                $items = Book::get('author');
                break;

            case 'books-authors':
                $items = Book::get(['title', 'author']);
                break;
        }

        if($format == 'csv')
        {
            $export = new BooksExport($type, $items);
            $file = $export->exportCSV($type, $items);
            return $file;
        }

        if($format == 'xml')
        {
            $file = BooksExport::exportXML($type, $items);
            return $file;
        }
    }
}
