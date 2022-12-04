@extends('layouts.layout')

@section('title', $title)

@section('content')
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="section-title">
                                <h4 class="m-0 text-uppercase font-weight-bold">{{ $title }}</h4>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="position-relative mb-3">
                                <div class="bg-white border border-top-0 p-4">
                                    <form role="form" method="POST" action="{{ route('books.update', $book) }}"
                                          enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" name="name"
                                                       class="form-control" id="name"
                                                       value="{{ $book->name }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea class="form-control" rows="6" placeholder="Description"
                                                          name="description"
                                                          id="description">{{ $book->description }}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="user_id">Author</label>
                                                <select class="form-control"
                                                        name="user_id"
                                                        id="user_id">
                                                    @foreach($users as $user)
                                                        <option value="{{ $user->id }}" @if($book->user_id == $user->id) selected @endif>{{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="image">Image</label>
                                                <input type="file" name="image" class="form-control dropify" id="image"
                                                       data-allowed-file-extensions="jpg jpeg png"
                                                       @if(!empty($book->image)) data-default-file="{{ asset("storage/{$book->image}") }}" @endif>
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-warning">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function () {
            $('.dropify').dropify();
        });
    </script>
@endpush
