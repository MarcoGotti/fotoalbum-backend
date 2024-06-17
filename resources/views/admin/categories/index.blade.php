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

    <div class="container">

        @include('admin.partials.success_message')

        <div class="table-responsive">
            <table class="table table-striped table-hover table-secondary align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody class="table-group-divider">
                    @forelse ($categories as $cat)
                        <tr class="table-secondary">
                            <td scope="row">{{ $cat->id }}</td>
                            <td>{{ $cat->name }}</td>
                            <td>{{ $cat->slug }}</td>
                            <td>
                                <div class="d-flex me-3">
                                    <a class="text-black" href="{{ route('admin.categories.show', $cat) }}">
                                        <i class="fa fa-eye" aria-hidden="true"></i></a>

                                    <a class="text-black mx-auto" href="{{ route('admin.categories.edit', $cat) }}">
                                        <i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <!-- Button trigger modal -->
                                    <a class="text-black" data-bs-toggle="modal"
                                        data-bs-target="#modalId-{{ $cat->id }}"
                                        href="{{ route('admin.categories.show', $cat) }}">
                                        <i class="fa fa-trash" aria-hidden="true"></i></a>



                                    <!-- Modal -->
                                    <div class="modal fade" id="modalId-{{ $cat->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="modalTitleId-{{ $cat->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content text-light">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalTitleId-{{ $cat->id }}">
                                                        {{ $cat->name }}
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>sure, you want to delete it?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-sm btn-secondary"
                                                        data-bs-dismiss="modal">
                                                        No
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

        <!-- Button trigger modal -->
        <a class="btn btn-warning border border-1 position-fixed bottom-0 end-0 m-5" data-bs-toggle="modal"
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
                                <label for="name" class="form-label">Name your Category</label>
                                <input type="text" class="form-control form-control-sm" name="name" id="name"
                                    placeholder="es. Body paint" />
                            </div>

                            <button class="btn btn-light btn-sm" type="submit">Save</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            var modalId = document.getElementById('modalId');

            modalId.addEventListener('show.bs.modal', function(event) {
                // Button that triggered the modal
                let button = event.relatedTarget;
                // Extract info from data-bs-* attributes
                let recipient = button.getAttribute('data-bs-whatever');

                // Use above variables to manipulate the DOM
            });
        </script>


    </div>



@endsection