@extends('layouts.admin')
@section('title', __('Services'))
@section('content')

    <div class="card services-list overflow-auto">
        <div class="card-header d-flex justify-content-between align-items-center">
            <a href="{{ route('services.create') }}" class="btn btn-primary">
                {{ __('Add New Service') }}
            </a>
        </div>
        <!-- Card body -->
        <div class="card-body">
            <!-- Table with responsive wrapper -->
            <div class="table-responfsive">
                <table class="table table-borderless datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th> {{ __('Service') }}</th>
                            <th> {{ __('Description') }}</th>
                            <th> {{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $service)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $service->{app()->getLocale() . '_name'} }}</td>
                                <td>{{ $service->{app()->getLocale() . '_description'} }}</td>
                                <td>
                                    {{-- <a href="{{ route('services.edit', $service->id) }}" class="btn btn-warning btn-sm">Edit</a> --}}
                                    {{-- show --}}
                                    <a href="{{ route('services.edit', $service->id) }}" class="btn btn-info btn-sm">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('services.destroy', $service->id) }}" method="POST"
                                        class="d-inline-block"
                                        onsubmit="return confirm('Are you want to delete this service?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
