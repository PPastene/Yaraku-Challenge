<?php

namespace App\Http\Repositories;

interface IBookRepository
{
    public function getBooks();
    public function addBook($data);
}
