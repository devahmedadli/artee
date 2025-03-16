@extends('layouts.admin')
@section('title', __('Product Details'))
@section('content')
    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0 text-primary">{{ $product->{app()->getLocale() . '_name'} }}</h2>
            <div>
                <a href="{{ route('products.edit', $product) }}" class="btn btn-primary">
                    <i class="bi bi-pencil"></i> {{ __('Edit') }}
                </a>
                <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline"
                    onsubmit="return confirm('{{ __('Are you sure you want to delete this product?') }}');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="bi bi-trash"></i> {{ __('Delete') }}
                    </button>
                </form>
            </div>
        </div>

        <div class="row g-4">
            <!-- Basic Product Information -->
            <div class="col-lg-12">
                <div class="card shadow-sm border-0 rounded-3 overflow-hidden">
                    <div class="card-header mb-3 bg-light py-3 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold"><i class="bi bi-info-circle me-2"></i>{{ __('Basic Information') }}</h5>
                        <span class="badge {{ $product->active ? 'bg-success' : 'bg-danger' }} px-3 py-2">
                            {{ $product->active ? __('Active') : __('Inactive') }}
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <h6 class="fw-bold text-muted">{{ __('Product Name (Arabic)') }}</h6>
                                            <p class="fs-5">{{ $product->ar_name }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <h6 class="fw-bold text-muted">{{ __('Product Name (English)') }}</h6>
                                            <p class="fs-5">{{ $product->en_name }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h6 class="fw-bold text-muted">{{ __('Base Price') }}</h6>
                                    <p class="fs-5 text-primary fw-bold">${{ number_format($product->base_price, 2) }}</p>
                                </div>

                                <div class="mb-4">
                                    <h6 class="fw-bold text-muted">{{ __('Description (Arabic)') }}</h6>
                                    <p>{{ $product->ar_description }}</p>
                                </div>

                                <div class="mb-4">
                                    <h6 class="fw-bold text-muted">{{ __('Description (English)') }}</h6>
                                    <p>{{ $product->en_description }}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center">
                                    <div class="card border-0 shadow-sm rounded-3 overflow-hidden mb-3">
                                        <img src="{{ $product->image_url }}" alt="{{ $product->en_name }}"
                                            class="img-fluid" style="width: 100%; height: 250px; object-fit: cover;">
                                    </div>
                                    <p class="text-muted small">{{ __('Product Image') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Options -->
            <div class="col-lg-12">
                <div class="card shadow-sm border-0 rounded-3 overflow-hidden">
                    <div class="card-header mb-3 bg-light py-3">
                        <h5 class="mb-0 fw-bold"><i class="bi bi-list-check me-2"></i>{{ __('Product Options') }}</h5>
                    </div>
                    <div class="card-body">
                        @forelse($product->options as $option)
                            <div class="option-group border rounded-3 p-4 mb-4 bg-light">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h6 class="mb-0 fw-bold">
                                        <span class="badge bg-primary me-2">{{ __('Option') }}</span>
                                        {{ $option->ar_name }} / {{ $option->en_name }}
                                    </h6>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>{{ __('Value') }}</th>
                                                <th>{{ __('Additional Price') }}</th>
                                                <th>{{ __('Requirements') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($option->values as $value)
                                                <tr>
                                                    <td>
                                                        <strong>{{ $value->ar_value }} / {{ $value->en_value }}</strong>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-success text-white">
                                                            ${{ number_format($value->price, 2) }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        @if ($value->requirements && count($value->requirements) > 0)
                                                            <button class="btn btn-sm btn-outline-primary" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#requirements-{{ $value->id }}"
                                                                aria-expanded="false">
                                                                <i class="bi bi-eye me-1"></i>{{ __('View') }}
                                                                <span
                                                                    class="badge bg-secondary">{{ count($value->requirements) }}</span>
                                                            </button>
                                                            <div class="collapse mt-2"
                                                                id="requirements-{{ $value->id }}">
                                                                <div class="card card-body p-3 border-0 shadow-sm">
                                                                    <ul class="list-group list-group-flush">
                                                                        @foreach ($value->requirements as $requirement)
                                                                            <li
                                                                                class="list-group-item px-0 py-2 border-bottom">
                                                                                <div
                                                                                    class="d-flex justify-content-between align-items-center">
                                                                                    <div>
                                                                                        <strong>{{ $requirement->ar_name }}
                                                                                            /
                                                                                            {{ $requirement->en_name }}</strong>
                                                                                        <div class="text-muted small">
                                                                                            <span
                                                                                                class="badge bg-info text-white me-2">{{ ucfirst($requirement->type) }}</span>
                                                                                            @if ($requirement->required)
                                                                                                <span
                                                                                                    class="badge bg-danger">{{ __('Required') }}</span>
                                                                                            @else
                                                                                                <span
                                                                                                    class="badge bg-secondary">{{ __('Optional') }}</span>
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <span
                                                                class="badge bg-light text-dark">{{ __('No requirements') }}</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-info text-center py-4">
                                <i class="bi bi-info-circle fs-4 d-block mb-2"></i>
                                <p class="mb-0">{{ __('No options available for this product') }}</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
