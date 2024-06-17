@extends('layouts.admin')
@section('pageTitle', 'Admin-photo-details')
@section('content')

    <header class="text-white py-4">
        <div class="container px-5 d-flex justify-content-between align-items-center">
            <h1>
                Details
            </h1>
            <a class="btn btn-sm btn-secondary" href="{{ route('admin.photos.index') }}">Back to list</a>
        </div>
    </header>

    @include('admin.partials.success_message')

    <div class="container padding_show my-3">
        <div class="row row-cols-1 row-cols-md-2">

            <div class="col">
                <img class="img-fluid border border-5 border-secondary rounded" src="{{ $photo->upload }}" alt="no image">
            </div>
            <div class="col d-flex flex-column">
                <h1 class="text-muted">{{ $photo->title }}</h1>

                <div class="categories d-flex flex-wrap gap-1">
                    @forelse ($photo->categories as $cat)
                        <a class="btn btn-secondary btn-sm" href="#">{{ $cat->name }}</a>
                    @empty
                        <div class="text-warning">Still no attached categories</div>
                    @endforelse
                </div>

                <p class="my-4">{{ $photo->description }}</p>

                <div class="mt-auto">
                    <div class="text-secondary">
                        <div><i class="fa-solid fa-calendar"></i> Published: {{ $photo->created_at }}</div>
                        <div class="my-1"><i class="fa-solid fa-location-dot"></i> &nbsp;Location: unknown</div>
                        <div><i class="fa-solid fa-circle-xmark"></i> This photo cannot be used without consens</div>
                        <div class="links mt-2">
                            <a class="btn btn-secondary" href="{{ $photo->upload }}" role="button" target="__blank">
                                <i class="fa fa-link" aria-hidden="true"></i> Link url
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



@endsection
