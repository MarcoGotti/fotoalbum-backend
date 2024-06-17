@extends('layouts.admin')
@section('pageTitle', 'Admin-cat-photos')
@section('content')

    <header class="text-white py-4">
        <div class="container d-flex justify-content-between align-items-center">
            <h3>
                Photos of <strong>{{ $category->name }}</strong>
            </h3>
            <a class="btn btn-sm btn-secondary" href="{{ route('admin.photos.index') }}">Back to list</a>
        </div>
    </header>

    <div class="container">
        <div class="row">

            <div class="col-2">

            </div>
        </div>
    </div>

@endsection
