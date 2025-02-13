@extends('layouts.home')
@section('title', __('Account'))
@section('content')
    @include('partials.page-hero', [
        'title' => __('Account'),
        'description' => __('Account Settings'),
    ])

    <main class="py-5">
        <div class="container">
            <div class="row">
                @include('partials.errors')
                <div class="col-md-4 mb-4">
                    <!-- Profile Image Upload -->
                    <div class="card shadow-sm border-0">
                        <div class="card-body text-center">
                            <div class="profile-image mb-5 rounded-4 p-3 text-center">
                                <h4 class="mb-5 text-muted">{{ __('Change Profile Image') }}</h4>
                                <form action="{{ route('customer.account.update-image') }}" method="post"
                                    enctype="multipart/form-data" class="needs-validation" novalidate>
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <input type="file" class="form-control d-none" id="image" name="image"
                                            onchange="showCropper(event)" accept="image/*" required>
                                        <input type="hidden" id="cropped_image" name="cropped_image">
                                        <div class="invalid-feedback">
                                            {{ __('Please select an image.') }}
                                        </div>
                                    </div>
                                    <label for="image"
                                        class="mb-3 rounded-circle p-2 bg-white border border-dark border-3" role="button">
                                        <img id="image_preview"
                                            src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('assets/imgs/avatar.png') }}"
                                            alt="Profile img" class="img-fluid rounded-circle" width="150"
                                            height="150">
                                    </label>
                                    <div class="invalid-feedback">
                                        {{ __('Please select an image.') }}
                                    </div>
                                    {{-- email --}}
                                    <div class="mb-3">
                                        {{ Auth::user()->email }}
                                    </div>
                                    <div class="">
                                        <button type="submit" class="btn btn-main px-5"
                                            onclick="submitForm(event)">{{ __('Save') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <!-- Account Settings -->
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-4">{{ __('Account Settings') }}</h5>
                            <form action="{{ route('customer.account.update-info') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ Auth::user()->name }}" required placeholder="{{ __('Name') }}">
                                    <label for="name">{{ __('Name') }}</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ Auth::user()->email }}" required placeholder="{{ __('Email') }}">
                                    <label for="email">{{ __('Email') }}</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="tel" class="form-control" id="phone" name="phone"
                                        value="{{ Auth::user()->phone }}" placeholder="{{ __('Phone') }}">
                                    <label for="phone">{{ __('Phone') }}</label>
                                </div>
                                <button type="submit" class="btn btn-main">{{ __('Update Account') }}</button>
                            </form>
                        </div>
                    </div>
                    <!-- Password Section -->
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <div class="password rounded-4 p-3">
                                <h4 class="mb-3 text-muted">{{ __('Password') }}</h4>
                                <form action="{{ route('customer.account.update-password') }}" method="post"
                                    class="needs-validation" novalidate>
                                    @csrf
                                    @method('PUT')
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" id="current_password"
                                            name="current_password" placeholder="{{ __('Current Password') }}" required>
                                        <label for="current_password">{{ __('Current Password') }}</label>
                                        <div class="invalid-feedback">
                                            {{ __('Please enter your current password') }}
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" id="new_password" name="new_password"
                                            placeholder="{{ __('New Password') }}" required>
                                        <label for="new_password">{{ __('New Password') }}</label>
                                        <div class="invalid-feedback">
                                            {{ __('Please enter your new password') }}
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" id="new_password_confirmation"
                                            name="new_password_confirmation" placeholder="{{ __('Confirm Password') }}"
                                            required>
                                        <label for="new_password_confirmation">{{ __('Confirm Password') }}</label>
                                        <div class="invalid-feedback">
                                            {{ __('Please confirm your new password') }}
                                        </div>
                                    </div>
                                    <div class="text-start">
                                        <button type="submit" class="btn btn-main">{{ __('Update Password') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Image Cropper Modal -->
    <div class="modal fade" id="imageCropperModal" tabindex="-1" aria-labelledby="imageCropperModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageCropperModalLabel">{{ __('Crop Image') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="cropper-container">
                        <img id="cropper-image" src="" alt="Image to crop" class="img-fluid">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="button" class="btn btn-primary"
                        onclick="cropImage()">{{ __('Crop and Save') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">
@endsection

@section('page-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <script>
        let cropper;

        function showCropper(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const cropperImage = document.getElementById('cropper-image');
                    cropperImage.src = e.target.result;
                    const modal = new bootstrap.Modal(document.getElementById('imageCropperModal'));
                    modal.show();

                    // Wait for the modal to be fully shown before initializing the cropper
                    document.getElementById('imageCropperModal').addEventListener('shown.bs.modal', function() {
                        if (cropper) {
                            cropper.destroy();
                        }

                        cropper = new Cropper(cropperImage, {
                            aspectRatio: 1,
                            viewMode: 1,
                            minCropBoxWidth: 200,
                            minCropBoxHeight: 200,
                        });
                    }, {
                        once: true
                    });
                }
                reader.readAsDataURL(file);
            }
        }

        function cropImage() {
            if (cropper) {
                const croppedCanvas = cropper.getCroppedCanvas({
                    width: 300,
                    height: 300
                });

                document.getElementById('image_preview').src = croppedCanvas.toDataURL();
                document.getElementById('cropped_image').value = croppedCanvas.toDataURL();

                const modal = bootstrap.Modal.getInstance(document.getElementById('imageCropperModal'));
                modal.hide();
            }
        }

        function submitForm(event) {
            event.preventDefault();
            const form = event.target.closest('form');
            const croppedImageInput = document.getElementById('cropped_image');

            if (croppedImageInput.value) {
                // Convert base64 to blob
                fetch(croppedImageInput.value)
                    .then(res => res.blob())
                    .then(blob => {
                        const file = new File([blob], "cropped_image.png", {
                            type: "image/png"
                        });
                        const dataTransfer = new DataTransfer();
                        dataTransfer.items.add(file);

                        // Replace the original file input with the cropped image
                        const fileInput = document.getElementById('image');
                        fileInput.files = dataTransfer.files;

                        // Submit the form
                        form.submit();
                    });
            } else {
                alert('Please select and crop an image before submitting.');
            }
        }
    </script>
@endsection

<!-- Custom CSS -->
<style>
    .card-title {
        font-size: 1.75rem;
        font-weight: bold;
    }


    ul,
    ol {
        padding-left: 1.5rem;
    }

    ul li,
    ol li {
        margin-bottom: 0.5rem;
    }
</style>
