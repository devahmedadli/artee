
@if ($errors->any)
    <div class="row">
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show rounded-0 p-3 m-1" role="alert">
                {{ $error }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endforeach
    </div>
@endif

{{-- @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-0 p-3 m-1" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif --}}
