@extends('layouts.home')
@section('title', __('Services'))

@section('content')
    @include('partials.page-hero', [
        'title' => __('Services'),
        'description' => __('Check our latest services'),
    ])


    <main class="py-5">
        <div class="container">
            <div class="row">
                @forelse ($services as $service)
                    <div class="col-md-4 mb-4">
                        <div class="service-icon mb-3">
                            <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->{app()->getLocale() . '_name'} }}" class="img-fluid">
                        </div>
                        <h4 class="mb-3">{{ $service->{app()->getLocale() . '_name'} }}</h4>
                        <p>{{ $service->{app()->getLocale() . '_description'} }}</p>
                        <div class="text-center mt-4">
                            @auth
                                <button type="button" class="btn btn-main" data-bs-toggle="modal"
                                    data-bs-target="#orderModal-{{ $service->id }}">
                                    {{ __('Get Started') }}
                                </button>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-main">
                                    {{ __('Login to order') }}
                                </a>
                            @endauth
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center fs-5">{{ __('No services found') }}</p>
                    </div>
                @endforelse
            </div>
        </div>
    </main>
@endsection

@foreach ($services as $service)
    <!-- Order Modal -->
    <div class="modal fade" id="orderModal-{{ $service->id }}" tabindex="-1" aria-labelledby="orderModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderModalLabel-{{ $service->id }}">{{ __('Place an Order') }}</h5>
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('customer.orders.store') }}" method="POST" class="needs-validation"
                        novalidate enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="service_id" value="{{ $service->id }}">
                        <div class="px-3">
                            @include('partials.errors')
                        </div>
                        {{-- choosen service --}}
                        <div class="mb-3">
                            <label for="service" class="form-label">{{ __('Service') }}</label>
                            <input type="text" class="form-control" id="service" value="{{ $service->{app()->getLocale() . '_name'} }}"
                                readonly>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">{{ __('Description') }}</label>
                            <textarea class="form-control" id="description" name="description" rows="6" required></textarea>
                            <div class="invalid-feedback">
                                {{ __('Please enter a description.') }}
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="attachments" class="form-label">{{ __('Attachments') }}</label>
                            <div class="custom-file-input">
                                <input type="file" class="file-input-hidden" id="attachments" name="attachments[]"
                                    multiple
                                    accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/zip,application/x-7z-compressed,image/png,image/jpeg,image/gif">
                                <div class="file-input-wrapper">
                                    <span class="file-input-text">{{ __('Choose files') }}</span>
                                    <button type="button"
                                        class="btn btn-outline-secondary">{{ __('Browse') }}</button>
                                </div>
                                <div id="file-list" class="mt-2"></div>
                            </div>
                        </div>

                        {{-- <div class="mb-3">
                                    <label for="amount" class="form-label">{{ __('Amount') }} $</label>
                                    <input type="number" class="form-control text-start" id="amount" name="amount"
                                        step="0.01" readonly>
                                </div> --}}
                        <button type="submit" class="btn btn-success">{{ __('Submit Order') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
@section('page-styles')
    <style>
        .custom-file-input {
            position: relative;
        }

        .file-input-hidden {
            position: absolute;
            left: -9999px;
        }

        .file-input-wrapper {
            display: flex;
            align-items: center;
            background-color: #f8f9fa;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            padding: 0.375rem 0.75rem;
        }

        .file-input-text {
            flex-grow: 1;
            margin-right: 10px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        #file-list {
            font-size: 0.875rem;
        }

        #file-list .file-item {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }

        #file-list .file-name {
            margin-right: 10px;
        }

        #file-list .remove-file {
            cursor: pointer;
            color: #dc3545;
        }
    </style>
@endsection
@section('page-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // File input handling for all modals
            document.querySelectorAll('.modal').forEach(modal => {
                const fileInput = modal.querySelector('input[type="file"]');
                const fileInputWrapper = modal.querySelector('.file-input-wrapper');
                const fileInputText = modal.querySelector('.file-input-text');
                const fileList = modal.querySelector('#file-list');

                if (fileInputWrapper && fileInput) {
                    fileInputWrapper.addEventListener('click', function() {
                        fileInput.click();
                    });

                    fileInput.addEventListener('change', function() {
                        updateFileList(fileInput, fileInputText, fileList);
                    });
                }

                if (fileList) {
                    fileList.addEventListener('click', function(e) {
                        const removeIcon = e.target.closest('.remove-file');
                        if (removeIcon) {
                            const index = parseInt(removeIcon.getAttribute('data-index'));
                            removeFile(fileInput, index, fileInputText, fileList);
                        }
                    });
                }
            });

            function updateFileList(fileInput, fileInputText, fileList) {
                fileList.innerHTML = '';
                if (fileInput.files.length > 0) {
                    fileInputText.textContent = `${fileInput.files.length} file(s) selected`;
                    Array.from(fileInput.files).forEach((file, index) => {
                        const fileItem = document.createElement('div');
                        fileItem.className = 'file-item';
                        fileItem.innerHTML = `
                            <span class="file-name">${file.name}</span>
                            <span class="remove-file" data-index="${index}"><i class="fa-solid fa-xmark fs-5 ms-2"></i></span>
                        `;
                        fileList.appendChild(fileItem);
                    });
                } else {
                    fileInputText.textContent = '{{ __('Choose files') }}';
                }
            }

            function removeFile(fileInput, index, fileInputText, fileList) {
                const dt = new DataTransfer();
                const { files } = fileInput;
                for (let i = 0; i < files.length; i++) {
                    if (i !== index) dt.items.add(files[i]);
                }
                fileInput.files = dt.files;
                updateFileList(fileInput, fileInputText, fileList);
            }

            // Show the order modal if the request has validation errors
            @if ($errors->any() || session('showOrderModal'))
                var serviceId = '{{ old('service_id', session('service_id')) }}';
                var orderModal = document.getElementById('orderModal-' + serviceId);
                if (orderModal) {
                    var modal = new bootstrap.Modal(orderModal);
                    modal.show();
                }
            @endif
        });
    </script>
@endsection
