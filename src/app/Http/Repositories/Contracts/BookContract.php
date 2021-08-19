<?php

namespace App\Http\Repositories\Contracts;

interface BookContract
{
    public function getBooks($data);
    public function addBook($data);
    public function editBook($data);
    public function deleteBook($id);
}
