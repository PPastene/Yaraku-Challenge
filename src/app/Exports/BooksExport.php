<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Facades\Excel;

class BooksExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    protected $params;

    public function __construct($params)
    {
        $this->params = $params;
    }

    public function collection()
    {
        return Book::all();
    }

    public function query()
    {

    }

    public static function export($params)
    {
        if($params->input('data') && $params->input('format'))
        {
            $now = time();
            $file = $params->input('data').'-'.$now.'.'.$params->input('format');
            $books;

            switch ( $params->input('data') )
            {
                case "books":
                    $books = Book::get("title");
                    break;

                case "authors":
                    $books = Book::get("author");
                    break;

                case "books-authors":
                    $books = Book::get(["title", "author"]);
                    break;
            }

            switch ( $params->input('format') )
            {
                case 'csv':
                    Excel::store(new BooksExport($params), $file, "public");
                    break;

                case 'xml':
                    Excel::store(new BooksExport($params), $file, "public");
                    break;
            }

            return $file;
        }
    }
}
