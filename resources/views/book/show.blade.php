@extends('layouts.layout')

@section('title', $title)

@section('content')
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="position-relative mb-3 my-card">
                        @if(empty($book->image))
                            <img class="img-fluid w-100" src="{{ asset('assets/img/no-photo.png') }}"
                                 style="object-fit: cover;">
                        @else
                            <img class="img-fluid w-100" src="{{ asset("storage/{$book->image}") }}"
                                 style="object-fit: cover;">
                        @endif
                        <div class="bg-white border border-top-0 p-4">
                            <div class="mb-3">
                                {{ $book->getDate() }}
                            </div>
                            <h1 class="mb-3 text-secondary text-uppercase font-weight-bold">{{ $book->name }}</h1>
                            <p>
                                @if(empty($book->description))
                                    Empty description
                                @else
                                    {{ $book->description }}
                                @endif
                            </p>
                            <div>
                                <a class="btn btn-warning" href="{{ route('books.edit', $book->id) }}">Edit</a>

                                <form action="{{ route('books.destroy', $book->id) }}" method="POST"
                                      class="float-left">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-warning"
                                            onclick="return confirm('Are you sure?');">Delete</button>
                                </form>
                            </div>
                        </div>
                            <div class="d-flex justify-content-between bg-white border border-top-0 p-4">
                                <div class="d-flex align-items-center">
                                    <span>{{ $book->author->name }}</span>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
