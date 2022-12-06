<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Services\BookService;
use App\Services\UserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class BookController extends Controller
{
    private BookService $bookService;
    private UserService $userService;

    public function __construct(BookService $bookService, UserService $userService)
    {
        $this->bookService = $bookService;
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $title = 'Books';
        $books = $this->bookService->paginate(config('app.pagination_count'));

        return view('book.index', compact('title', 'books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $title = 'Create book';
        $users = $this->userService->all();

        return view('book.create', compact('title', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BookRequest $request
     * @return RedirectResponse
     */
    public function store(BookRequest $request)
    {
        $data = $request->all();
        $this->bookService->add($data);

        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Book $book
     * @return Application|Factory|View
     */
    public function show(Book $book)
    {
        $title = 'Book';

        return view('book.show', compact('title', 'book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Book $book
     * @return Application|Factory|View
     */
    public function edit(Book $book)
    {
        $title = 'Edit book';
        $users = $this->userService->all();

        return view('book.edit', compact('title', 'book', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BookRequest $request
     * @param Book $book
     * @return RedirectResponse
     */
    public function update(BookRequest $request, Book $book)
    {
        $data = $request->all();
        $book = $this->bookService->edit($book, $data);

        return redirect()->route('books.show', $book);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Book $book
     * @return RedirectResponse
     */
    public function destroy(Book $book)
    {
        $this->bookService->remove($book);

        return redirect()->route('books.index');
    }
}
