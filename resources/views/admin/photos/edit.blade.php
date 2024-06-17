@extends('layouts.admin')
@section('pageTitle', 'Admin-edit-photo')
@section('content')

    @include('admin.photos.partials.form_errors')

    <div class="container-fluid jumbotron_edit position-relative" style="background-image: url({{ $photo->upload }})">
        <a class="btn btn-sm btn-secondary position" href="{{ route('admin.photos.index') }}">Back to
            list</a>
    </div>

    <div class="container py-5">

        <form action="{{ route('admin.photos.update', $photo) }}" method="post">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <input type="text"
                    class="form-control w-50 form-control-sm @error('title') is-invalid                 
                @enderror"
                    name="title" aria-describedby="titleHelper" value="{{ old('title', $photo->title) }}" />
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="row flex-wrap my-5">
                @forelse ($categories as $cat)
                    <div class="col">
                        <div class="form-check">
                            @if ($errors->any())
                                <input class="form-check-input" type="checkbox" value="{{ $cat->id }}"
                                    id="cat-{{ $cat->id }}" name="categories[]"
                                    {{ in_array($cat->id, old('categories', [])) ? 'checked' : '' }} />
                                <label class="form-check-label" for="cat-{{ $cat->id }}"> {{ $cat->name }} </label>
                            @else
                                <input class="form-check-input" type="checkbox" value="{{ $cat->id }}"
                                    id="cat-{{ $cat->id }}" name="categories[]"
                                    {{ $photo->categories->contains($cat->id) ? 'checked' : '' }} />
                                <label class="form-check-label" for="cat-{{ $cat->id }}"> {{ $cat->name }}
                                </label>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="p-3 text-bg-warning">
                        <div>You haven't got any category in your database!</div>
                        <div>I recommand you add a few categories to relate to your photos.</div>
                    </div>
                @endforelse
            </div>

            <div class="d-flex gap-3">

                <div class="overflow-hidden border border-5 border-secondary rounded" style="height: 140px">
                    <img width="300" src="{{ $photo->upload }}" alt="">
                </div>

                <div class="d-flex w-25 flex-column">
                    <div>
                        <label for="upload" class="form-label">Insert the image url</label>
                        <input type="text"
                            class="form-control @error('upload') is-invalid                 
                        @enderror"
                            name="upload" aria-describedby="uploadUrlHelper" placeholder="es. https:// ...."
                            value="{{ old('upload', $photo->upload) }}" />
                        @error('upload')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check mt-auto">
                        <input class="form-check-input" type="checkbox" value="" name="image_delete" disabled />
                        <label class="form-check-label" for="image_delete">Check to delete</label>
                    </div>
                </div>
            </div>


            <div class="mb-3">
                <label for="description" class="form-label"></label>
                <textarea
                    class="form-control form-control-sm w-50 @error('description') is-invalid                 
                @enderror"
                    name="description" rows="3" placeholder="Description here">{{ old('description', $photo->description) }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button class="btn btn-light" type="submit">Update</button>
        </form>
    </div>

@endsection
