<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Http\Resources\Book\BookResource;
use App\Models\Book;
use App\Services\BookService;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{
    private BookService $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $books = $this->bookService->all();

        return BookResource::collection($books);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BookRequest $request
     * @return BookResource
     */
    public function store(BookRequest $request)
    {
        $data = $request->all();
        $book = $this->bookService->add($data);

        return new BookResource($book);
    }

    /**
     * Display the specified resource.
     *
     * @param Book $book
     * @return BookResource
     */
    public function show(Book $book)
    {
        return new BookResource($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BookRequest $request
     * @param Book $book
     * @return BookResource
     */
    public function update(BookRequest $request, Book $book)
    {
        $data = $request->all();
        $book = $this->bookService->edit($book, $data);

        return new BookResource($book);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Book $book
     * @return JsonResponse
     */
    public function destroy(Book $book)
    {
        $this->bookService->remove($book);

        return response()->json([], 204);
    }
}
