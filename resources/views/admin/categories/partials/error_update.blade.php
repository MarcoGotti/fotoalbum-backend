@if ($errors->any())
    <div class="alert alert-danger text-center">
        <div><strong>Error! </strong>You have to write a category and it must be a new one</div>
        {{-- <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul> --}}
    </div>
@endif
