@extends('layouts.admin')
@section('title', __('Edit Site Settings'))
@section('content')
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="">
            <form action="{{ route('site-settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Basic Info Column -->
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header bg-light mb-3">
                                <h3 class="h5 mb-0">{{ __('Basic Information') }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">{{ __('Site Name') }}</label>
                                    <input type="text" name="name" id="name"
                                        value="{{ $settings->name }}" class="form-control" required>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for="logo" class="form-label">{{ __('Logo') }}</label>
                                    <input type="file" name="logo" id="logo" class="form-control" accept="image/*">
                                    @if($settings->logo)
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/' . $settings->logo) }}" alt="Logo" class="img-thumbnail" style="height: 50px">
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group mb-3">
                                    <label for="favicon" class="form-label">{{ __('Favicon') }}</label>
                                    <input type="file" name="favicon" id="favicon" class="form-control" accept="image/*">
                                    @if($settings->favicon)
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/' . $settings->favicon) }}" alt="Favicon" class="img-thumbnail" style="height: 32px">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Social Media Card -->
                        <div class="card mb-4">
                            <div class="card-header bg-light mb-3">
                                <h3 class="h5 mb-0">{{ __('Social Media') }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label for="social_media_facebook" class="form-label">{{ __('Facebook') }}</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fab fa-facebook"></i></span>
                                        <input type="url" name="social_media[facebook]" id="social_media_facebook"
                                            value="{{ $settings->social_media['facebook'] }}" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="social_media_instagram" class="form-label">{{ __('Instagram') }}</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fab fa-instagram"></i></span>
                                        <input type="url" name="social_media[instagram]" id="social_media_instagram"
                                            value="{{ $settings->social_media['instagram'] }}" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="social_media_twitter" class="form-label">{{ __('Twitter') }}</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fab fa-twitter"></i></span>
                                        <input type="url" name="social_media[twitter]" id="social_media_twitter"
                                            value="{{ $settings->social_media['twitter'] }}" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="social_media_linkedin" class="form-label">{{ __('LinkedIn') }}</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fab fa-linkedin"></i></span>
                                        <input type="url" name="social_media[linkedin]" id="social_media_linkedin"
                                            value="{{ $settings->social_media['linkedin'] }}" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="social_media_youtube" class="form-label">{{ __('YouTube') }}</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fab fa-youtube"></i></span>
                                        <input type="url" name="social_media[youtube]" id="social_media_youtube"
                                            value="{{ $settings->social_media['youtube'] }}" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact & Colors Column -->
                    <div class="col-md-6">
                        <!-- Contact Information Card -->
                        <div class="card mb-4">
                            <div class="card-header bg-light mb-3">
                                <h3 class="h5 mb-0">{{ __('Contact Information') }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label for="contact_phone" class="form-label">{{ __('Phone') }}</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        <input type="text" name="contact[phone]" id="contact_phone"
                                            value="{{ $settings->contact['phone'] }}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="contact_email" class="form-label">{{ __('Email') }}</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        <input type="email" name="contact[email]" id="contact_email"
                                            value="{{ $settings->contact['email'] }}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="contact_address" class="form-label">{{ __('Address') }}</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                        <input type="text" name="contact[address]" id="contact_address"
                                            value="{{ $settings->contact['address'] }}" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Colors Card -->
                        <div class="card">
                            <div class="card-header bg-light mb-3">
                                <h3 class="h5 mb-0">{{ __('Colors') }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="colors_primary" class="form-label">{{ __('Primary') }}</label>
                                            <input type="color" name="colors[primary]" id="colors_primary"
                                                value="{{ $settings->colors['primary'] }}"
                                                class="form-control form-control-color w-100" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="colors_primary_dark" class="form-label">{{ __('Primary Dark') }}</label>
                                            <input type="color" name="colors[primary-dark]" id="colors_primary_dark"
                                                value="{{ $settings->colors['primary-dark'] }}"
                                                class="form-control form-control-color w-100" required>
                                        </div>
                                        
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="colors_secondary" class="form-label">{{ __('Secondary') }}</label>
                                            <input type="color" name="colors[secondary]" id="colors_secondary"
                                                value="{{ $settings->colors['secondary'] }}"
                                                class="form-control form-control-color w-100" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="colors_secondary_dark" class="form-label">{{ __('Secondary Dark') }}</label>
                                            <input type="color" name="colors[secondary-dark]" id="colors_secondary_dark"
                                                value="{{ $settings->colors['secondary-dark'] }}"
                                                class="form-control form-control-color w-100" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="colors_tertiary" class="form-label">{{ __('Tertiary') }}</label>
                                            <input type="color" name="colors[tertiary]" id="colors_tertiary"
                                                value="{{ $settings->colors['tertiary'] }}"
                                                class="form-control form-control-color w-100" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="colors_tertiary_dark" class="form-label">{{ __('Tertiary Dark') }}</label>
                                            <input type="color" name="colors[tertiary-dark]" id="colors_tertiary_dark"
                                                value="{{ $settings->colors['tertiary-dark'] }}"
                                                class="form-control form-control-color w-100" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save me-2"></i>{{ __('Update Settings') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
