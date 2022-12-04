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
                                <a href="{{ route('specializations.create') }}" class='btn btn-warning'>Create</a>
                            </div>
                        </div>
                        @foreach($specializations as $specialization)
                            <div class="col-lg-6">
                            <div class="position-relative mb-3">
                                @if(empty($specialization->image))
                                    <img class="img-fluid w-100" src="{{ asset('assets/img/no-photo.png') }}" style="object-fit: cover;">
                                @else
                                    <img class="img-fluid w-100" src="{{ asset("storage/{$specialization->image}") }}" style="object-fit: cover;">
                                @endif

                                <div class="bg-white border border-top-0 p-4">
                                    <div class="mb-2">
                                        <small>{{ $specialization->getDate() }}</small>
                                    </div>
                                    <a class="h4 d-block mb-3 text-secondary text-uppercase font-weight-bold" href="{{ route('specializations.show', $specialization) }}">{{ $specialization->name }}</a>
                                    <p class="m-0">
                                        @if(empty($specialization->description))
                                            Empty description
                                        @else
                                            {{ $specialization->description }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        {{ $specializations->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
