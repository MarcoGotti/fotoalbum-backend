@extends('layouts.admin')
@section('pageTitle', 'Admin-add-photo')
@section('content')

    @include('admin.partials.form_errors')

    <header class="text-white py-4">
        <div class="container d-flex justify-content-between align-items-center">
            <h3>
                Add Photo
            </h3>
            <a class="btn btn-sm btn-secondary" href="{{ route('admin.photos.index') }}">Back to list</a>
        </div>
    </header>

    <div class="container">

        <form action="{{ route('admin.photos.store') }}" method="post">
            @csrf

            <div class="mb-3">
                <input type="text"
                    class="form-control form-control-sm @error('title') is-invalid                 
                @enderror"
                    name="title" aria-describedby="titleHelper" placeholder="Title your picture" />
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- <div class="d-flex flex-wrap border-1 border border-warning">
                <h6 class="col-12 text-warning text-center">Upload the image ...</h6>
                <div class="col-5 p-3">
                    <label for="upload" class="form-label text-warning">... from a Url</label>
                    <input type="text" class="form-control" name="upload" aria-describedby="uploadUrlHelper"
                        placeholder="es. https:// ...." />
                    <small id="uploadUrlHelper" class="form-text text-muted">Don't be silly! Type here a link</small>
                </div>
                <div class="col-2 d-flex justify-content-center align-items-center text-warning">
                    <h4>... OR ...</h4>
                </div>
                <div class="col-5 p-3">
                    <label for="upload" class="form-label text-warning">... choose file</label>
                    <input type="file" class="form-control" name="upload" aria-describedby="uploadFileHelper" />
                    <div id="uploadFileHelper" class="form-text">Search a file in your devices' storage</div>
                </div>
            </div> --}}

            <div>
                <label for="upload" class="form-label">Insert the image url</label>
                <input type="text"
                    class="form-control @error('upload') is-invalid                 
                @enderror"
                    name="upload" aria-describedby="uploadUrlHelper" placeholder="es. https:// ...." />
                @error('upload')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="description" class="form-label"></label>
                <textarea
                    class="form-control form-control-sm @error('description') is-invalid                 
                @enderror"
                    name="description" rows="3" placeholder="Description here"></textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button class="btn btn-light" type="submit">Save</button>

        </form>

    </div>

@endsection
