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
                                <a href="{{ route('workers.create') }}" class='btn btn-warning'>Create</a>
                            </div>
                        </div>
                        @foreach($workers as $worker)
                            <div class="col-lg-6">
                                <div class="position-relative mb-3">
                                    @if(empty($worker->image))
                                        <img class="img-fluid w-100" src="{{ asset('assets/img/no-photo.png') }}" style="object-fit: cover;">
                                    @else
                                        <img class="img-fluid w-100" src="{{ asset("storage/{$worker->image}") }}" style="object-fit: cover;">
                                    @endif

                                    <div class="bg-white border border-top-0 p-4">
                                        <div class="mb-2">
                                            <small>{{ $worker->getDate() }}</small>
                                        </div>
                                        <a class="h4 d-block mb-3 text-secondary text-uppercase font-weight-bold" href="{{ route('workers.show', $worker) }}">{{ $worker->name }}</a>
                                        <p class="m-0">
                                            @if(empty($worker->description))
                                                Empty description
                                            @else
                                                {{ $worker->description }}
                                            @endif
                                        </p>
                                    </div>
                                    <div class="d-flex justify-content-between bg-white border border-top-0 p-4">
                                        <div class="d-flex align-items-center">
                                            <small>{{ $worker->specialization->name }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{ $workers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
