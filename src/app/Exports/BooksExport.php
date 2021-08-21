<?php

namespace App\Exports;

use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Sabre\Xml\Service;

class BooksExport implements FromCollection, WithHeadings
{
    use Exportable;

    public function __construct($type, $items)
    {
        $this->type = $type;
        $this->items = $items;
    }

    public function collection()
    {
        return $this->items;
    }

    public static function exportCSV($type, $collection)
    {
        $now = time();
        $file = $type.'-'.$now.'.csv';

        Excel::store(new BooksExport($type, $collection), $file, "public");

        return $file;
    }

    public static function exportXML($type, $collection)
    {
        // https://www.guru99.com/php-and-xml.html#8
        $now = time();
        $file = $type.'-'.$now.'.xml';

        $dom = new \DOMDocument("1.0");
        $dom->encoding = 'utf-8';
		$dom->xmlVersion = '1.0';
		$dom->formatOutput = true;

		$root = $dom->createElement('Books');

        if($type == 'books')
        {
            foreach($collection as $item)
            {
                $book_node = $dom->createElement('book');
                $book_title = $dom->createElement('title', $item['title']);
                $book_node->appendChild($book_title);
                $root->appendChild($book_node);
            }
        }

        if($type == 'authors')
        {
            foreach($collection as $item)
            {
                $book_node = $dom->createElement('book');
                $book_author = $dom->createElement('author', $item['author']);
                $book_node->appendChild($book_author);
                $root->appendChild($book_node);
            }
        }

        if($type == 'books-authors')
        {
            foreach($collection as $item)
            {
                $book_node = $dom->createElement('book');
                $book_title = $dom->createElement('title', $item['title']);
                $book_author = $dom->createElement('author', $item['author']);
                $book_node->appendChild($book_title);
                $root->appendChild($book_node);
                $book_node->appendChild($book_author);
                $root->appendChild($book_node);
            }
        }
		$dom->appendChild($root);

        $dom->formatOutput = true;
        $archivo = $dom->saveXML();
        Storage::disk('local')->put('public/'.$file, $archivo);

        return $file;

    }

    public function headings(): array
    {
        if($this->type == 'books')
        {
            return ['Title',];
        }

        if($this->type == 'authors')
        {
            return ['Author',];
        }

        if($this->type == 'books-authors')
        {
            return ['Title','Author',];
        }
    }
}
