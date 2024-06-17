@if ($errors->any())
    <div class="alert alert-danger text-center">
        <div><strong>Error! </strong>This category already exists</div>
        {{-- <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul> --}}
    </div>
@endif
