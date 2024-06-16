@extends('layouts.admin')
@section('pageTitle', 'Admin-photos-index')
@section('content')

    <header class="text-white py-4">
        <div class="container d-flex justify-content-between align-items-center">
            <h3>
                Photos: list of all
            </h3>
            <a class="btn btn-sm btn-secondary" href="{{ route('admin.dashboard') }}">Back to Dashboard</a>
        </div>
    </header>

    <div class="container">
        @if (session('message'))
            <div class="alert alert-success">
                <strong>Great!</strong>{{ session('message') }}
            </div>
        @endif
        <div class="table-responsive">
            <table class="table table-striped table-hover table-secondary align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Upload</th>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody class="table-group-divider">
                    @forelse ($photos as $photo)
                        <tr class="table-secondary">
                            <td scope="row">{{ $photo->id }}</td>
                            <td>
                                <div class="wrapper overflow-y-hidden" data-bs-toggle="modal"
                                    data-bs-target="#modalId-{{ $photo->id }}">
                                    <img width="100%" src="{{ $photo->upload }}" alt="">
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="modalId-{{ $photo->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="modalTitleId-{{ $photo->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">

                                            <div class="modal-body position-relative">
                                                <button type="button" class="btn-close position-absolute top-0 end-0 m-3"
                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                <img width="100%" src="{{ $photo->upload }}" alt="">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $photo->title }}</td>
                            <td>{{ $photo->slug }}</td>
                            <td>
                                <div class="d-flex me-3">
                                    <a class="text-black" href="{{ route('admin.photos.show', $photo) }}">
                                        <i class="fa fa-eye" aria-hidden="true"></i></a>

                                    <a class="text-black mx-auto" href="{{ route('admin.photos.show', $photo) }}">
                                        <i class="fa fa-pencil" aria-hidden="true"></i></a>

                                    <a class="text-black" href="{{ route('admin.photos.show', $photo) }}">
                                        <i class="fa fa-trash" aria-hidden="true"></i></a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td scope="row" colspan="4">
                                <h2>No Pics here, body! Go to work!</h2>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    {{ $photos->links('pagination::bootstrap-5') }}
                </tfoot>
            </table>
            {{ $photos->links('pagination::bootstrap-5') }}
        </div>

        <a class="btn btn-warning border border-1 position-fixed bottom-0 end-0 m-5"
            href="{{ route('admin.photos.create') }}"><i class="fa fa-plus-square" aria-hidden="true"></i>&nbsp; Add</a>

    </div>



@endsection
