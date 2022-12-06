<?php

namespace App\Services;

use App\Models\Book;

class BookService
{
    public function paginate(int $count)
    {
        return Book::with('author')->paginate($count);
    }

    public function all()
    {
        return Book::with('author')->get();
    }

    public function add(array $data)
    {
        return Book::add($data);
    }

    public function remove($book)
    {
        $book->remove();
        return true;
    }

    public function edit($book, array $data)
    {
        return $book->edit($data);
    }
}
