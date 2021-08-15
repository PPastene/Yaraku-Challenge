<?php

namespace App\Http\Repositories\Contracts;

interface BookContract
{
    public function getBooks();
    public function addBook($data);
    public function deleteBook($id);
    public function searchBook($data);
}
