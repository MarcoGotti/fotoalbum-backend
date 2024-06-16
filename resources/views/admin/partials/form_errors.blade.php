@if ($errors->any())
    <div class="alert alert-danger text-center">
        <h5>Errors!</h5>
        {{-- <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul> --}}
    </div>
@endif
