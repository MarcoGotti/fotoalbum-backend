@extends('layouts.admin')
@section('pageTitle', 'Admin-categories-index')
@section('content')

    <header class="text-white py-4">
        <div class="container d-flex justify-content-between align-items-center">
            <h3>
                Categories: list
            </h3>
            <a class="btn btn-sm btn-secondary" href="{{ route('admin.dashboard') }}">Back to Dashboard</a>
        </div>
    </header>

    @include('admin.partials.success_message')
    @include('admin.categories.partials.error_update')

    <div class="container mt-5" style="padding: 0 6rem;">

        <div class="table-responsive">
            <table class="table table-striped table-hover table-secondary align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th class="text-center">View all related Photos</th>
                        <th class="text-end">Delete</th>
                    </tr>
                </thead>

                <tbody class="table-group-divider">
                    @forelse ($categories as $cat)
                        <tr class="table-secondary">
                            <td scope="row">{{ $cat->id }}</td>
                            <td>
                                <form action="{{ route('admin.categories.update', $cat) }}" method="post">
                                    @csrf
                                    @method('patch')

                                    <div class="mb-3">
                                        <input type="text" class="w-50 form-control form-control-sm" name="name"
                                            value="{{ $cat->name }}" />
                                    </div>

                                </form>
                            </td>
                            <td>{{ $cat->slug }}</td>
                            <td class="text-center">
                                <a class="btn btn-success btn-sm" href="{{ route('admin.categories.show', $cat) }}">
                                    <i class="fa fa-eye" aria-hidden="true"></i> View</a>
                            </td>
                            <td>
                                <div class="d-flex me-3">

                                    <!-- Destroy-action Button trigger modal -->
                                    <a class="text-black ms-auto" data-bs-toggle="modal"
                                        data-bs-target="#modalId-{{ $cat->id }}"
                                        href="{{ route('admin.categories.show', $cat) }}">
                                        <i class="fa fa-trash" aria-hidden="true"></i></a>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modalId-{{ $cat->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="modalTitleId-{{ $cat->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content text-light">
                                                <div class="modal-header">
                                                    <p>You are about to delete this category</p>


                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <h4 class="modal-title text-uppercase"
                                                        id="modalTitleId-{{ $cat->id }}">
                                                        {{ $cat->name }}
                                                    </h4>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-sm btn-secondary"
                                                        data-bs-dismiss="modal">
                                                        No, don't
                                                        <form action="{{ route('admin.categories.destroy', $cat) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button class="btn btn-sm btn-danger" type="submit">Yes,
                                                                delete</button>
                                                        </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                    {{ $categories->links('pagination::bootstrap-5') }}
                </tfoot>
            </table>
            {{ $categories->links('pagination::bootstrap-5') }}
        </div>

        <!-- Create-action Button trigger modal -->
        <a class="btn btn-danger border border-1 position-fixed bottom-0 end-0 m-5" data-bs-toggle="modal"
            data-bs-target="#modalCreate" href="{{ route('admin.categories.create') }}"><i class="fa fa-plus-square"
                aria-hidden="true"></i>&nbsp; Add</a>

        <!-- Modal -->
        <div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Add a new category in your DB
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.categories.store') }}" method="post">
                            @csrf

                            <div class="mb-3">
                                <input type="text"
                                    class="form-control form-control-sm @error('name') is-invalid                                   
                                @enderror"
                                    name="name" id="name" placeholder="es. Body paint"
                                    value="{{ old('name') }}" />
                                @error('name')
                                    <div class="text-danger"><strong>{{ old('name') }}</strong>: {{ $message }}</div>
                                @enderror
                            </div>

                            <button class="btn btn-light btn-sm" type="submit">Save</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
