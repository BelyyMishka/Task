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

    public function getById($id)
    {
        return Book::with('author')->find($id);
    }

    public function add($request)
    {
        $book = Book::add($request);
        return $book->load('author');
    }

    public function remove($book)
    {
        $book->remove();
        return true;
    }

    public function edit($book, $request)
    {
        $book = $book->edit($request);

        return $book->load('author');
    }
}
