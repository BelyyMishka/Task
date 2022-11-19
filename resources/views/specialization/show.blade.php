@extends('layouts.layout')

@section('title', $title)

@section('content')
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="position-relative mb-3 my-card">
                        @if(empty($specialization->image))
                            <img class="img-fluid w-100" src="{{ asset('assets/img/no-photo.png') }}"
                                 style="object-fit: cover;">
                        @else
                            <img class="img-fluid w-100" src="{{ asset("storage/{$specialization->image}") }}"
                                 style="object-fit: cover;">
                        @endif
                        <div class="bg-white border border-top-0 p-4">
                            <div class="mb-3">
                                {{ $specialization->getDate() }}
                            </div>
                            <h1 class="mb-3 text-secondary text-uppercase font-weight-bold">{{ $specialization->name }}</h1>
                            <p>
                                @if(empty($specialization->description))
                                    Empty description
                                @else
                                    {{ $specialization->description }}
                                @endif
                            </p>
                            <div>
                                <a class="btn btn-warning" href="{{ route('specializations.edit', $specialization->id) }}">Edit</a>

                                <form action="{{ route('specializations.destroy', $specialization->id) }}" method="POST"
                                      class="float-left">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-warning"
                                            onclick="return confirm('Are you sure?');">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
