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
                                    <form role="form" method="POST" action="{{ route('workers.update', $worker) }}"
                                          enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" name="name"
                                                       class="form-control" id="name"
                                                       value="{{ $worker->name }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea class="form-control" rows="6" placeholder="Description"
                                                          name="description"
                                                          id="description">{{ $worker->description }}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="specialization_id">Specialization</label>
                                                <select class="form-control"
                                                        name="specialization_id"
                                                        id="specialization_id">
                                                    @foreach($specializations as $specialization)
                                                        <option value="{{ $specialization->id }}" @if($worker->specialization_id == $specialization->id) selected @endif>{{ $specialization->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="image">Image</label>
                                                <input type="file" name="image" class="form-control dropify" id="image"
                                                       data-allowed-file-extensions="jpg jpeg png"
                                                       @if(!empty($worker->image)) data-default-file="{{ asset("storage/{$worker->image}") }}" @endif>
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
