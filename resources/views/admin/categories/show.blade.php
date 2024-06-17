@extends('layouts.admin')
@section('pageTitle', 'Admin-cat-photos')
@section('content')

    <header class="text-white py-4">
        <div class="container d-flex justify-content-between align-items-center">
            <h3>
                Photos of <strong>{{ $category->name }}</strong>
            </h3>
            <a class="btn btn-sm btn-secondary" href="{{ route('admin.categories.index') }}">Back to list</a>
        </div>
    </header>

    <div class="container">
        <div class="row g-2">
            @forelse ($category->photos as $photo)
                <div class="col-2">
                    <div class="card h-100 border border-5 border-secondary rounded">
                        <a href="{{ route('admin.photos.show', $photo) }}">
                            <img class="img-fluid" src="{{ $photo->upload }}" alt="no image">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">{{ $photo->title }}</h5>
                        </div>
                    </div>
                </div>

            @empty
                <div class="col-12 mt-5 border border-warning border-1 text-center">
                    <h4 class="text-warning">There are no photos related to category <strong>{{ $category->name }}</strong>.
                        Go make some!
                    </h4>
                </div>
            @endforelse

            <div class="col-2">

            </div>
        </div>
    </div>

@endsection
