@if (session('message'))
    <div class="alert alert-success text-center">
        <strong>Great!</strong> {{ session('message') }}
    </div>
@endif
