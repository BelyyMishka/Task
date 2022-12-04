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
                                    <form role="form" method="POST" action="{{ route('workers.store') }}"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" name="name"
                                                       class="form-control" id="name"
                                                       placeholder="Name" value="{{ old('name') }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea class="form-control" rows="6" placeholder="Description"
                                                          name="description"
                                                          id="description">{{ old('description') }}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="specialization_id">Specialization</label>
                                                <select class="form-control"
                                                        name="specialization_id"
                                                        id="specialization_id">
                                                    @for($i = 0; $i < $specializations->count(); $i++)
                                                        <option value="{{ $specializations[$i]->id }}">{{ $specializations[$i]->name }}</option>
                                                    @endfor
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="image">Image</label>
                                                <input type="file" name="image" class="form-control dropify" id="image"
                                                       data-allowed-file-extensions="jpg jpeg png">
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