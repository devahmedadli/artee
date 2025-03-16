@extends('layouts.admin')
@section('title', __('Products'))
@section('content')

    <div class="card products-list overflow-auto">
        <!-- Card body -->
        <div class="card-body">
            <h5 class="card-title">{{ __('Products List') }} <span>| {{ __('All') }}</span></h5>
            {{-- Add product button --}}
            <div>
                <a href="{{ route('products.create') }}" class="btn btn-primary">
                    {{ __('Add Product') }}
                </a>
            </div>
            <!-- Table with responsive wrapper -->
            <div class="table-responsive">
                <table class="table table-borderless datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Arabic Name') }}</th>
                            <th>{{ __('English Name') }}</th>
                            <th>{{ __('Base Price') }}</th>
                            <th>{{ __('Full Price') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $product->ar_name }}</td>
                                <td>{{ $product->en_name }}</td>
                                <td>{{ $product->base_price }}</td>
                                <td>{{ $product->full_price }}</td>
                                <td>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-info btn-sm">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary btn-sm">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                        class="d-inline-block"
                                        onsubmit="return confirm('{{ __('Are you sure?') }}');">
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
