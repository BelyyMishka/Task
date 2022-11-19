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
        return Book::with('author')->findOrFail($id);
    }

    public function add($request)
    {
        $book = Book::add($request);
        return $book->load('author');
    }

    public function remove($id)
    {
        $book = $this->getById($id);
        $book->remove();
        return true;
    }

    public function edit($id, $request)
    {
        $book = $this->getById($id);
        $book = $book->edit($request);

        return $book->load('author');
    }
}
