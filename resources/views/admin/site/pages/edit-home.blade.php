@extends('layouts.admin')
@section('title', __('Edit Page'))
@section('content')
    @include('partials.errors')

    <div class="container-fluid">
        <form action="{{ route('home-page.update', $page->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- Page Details -->
            <div class="card mb-4">
                <div class="card-header bg-light mb-3">
                    <h5 class="card-title">{{ __('Page Details') }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Title (English)') }}</label>
                                <input type="text" name="name[en]" class="form-control"
                                    value="{{ $page->name['en'] ?? '' }}">
                                @error('name.en')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Title (Arabic)') }}</label>
                                <input type="text" name="name[ar]" class="form-control" dir="rtl"
                                    value="{{ $page->name['ar'] ?? '' }}">
                                @error('name.ar')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Description (English)') }}</label>
                                <textarea name="description[en]" class="form-control">{{ $page->description['en'] ?? '' }}</textarea>
                                @error('description.en')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Description (Arabic)') }}</label>
                                <textarea name="description[ar]" class="form-control" dir="rtl">{{ $page->description['ar'] ?? '' }}</textarea>
                                @error('description.ar')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Hero Section -->
            <div class="card mb-4">
                <div class="card-header bg-light mb-3">
                    <h5 class="card-title">{{ __('Hero Section') }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Title (Arabic)') }}</label>
                                <input type="text" name="hero[title][ar]" class="form-control" dir="rtl"
                                    value="{{ $page->sections['hero']['title']['ar'] ?? '' }}">
                                @error('hero.title.ar')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Subtitle (Arabic)') }}</label>
                                <input type="text" name="hero[subtitle][ar]" class="form-control" dir="rtl"
                                    value="{{ $page->sections['hero']['subtitle']['ar'] ?? '' }}">
                                @error('hero.subtitle.ar')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Title (English)') }}</label>
                                <input type="text" name="hero[title][en]" class="form-control"
                                    value="{{ $page->sections['hero']['title']['en'] ?? '' }}">
                                @error('hero.title.en')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Subtitle (English)') }}</label>
                                <input type="text" name="hero[subtitle][en]" class="form-control"
                                    value="{{ $page->sections['hero']['subtitle']['en'] ?? '' }}">
                                @error('hero.subtitle.en')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Button (English)') }}</label>
                                <input type="text" name="hero[button][en]" class="form-control"
                                    value="{{ $page->sections['hero']['button']['en'] ?? '' }}">
                                @error('hero.button.en')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Button (Arabic)') }}</label>
                                <input type="text" name="hero[button][ar]" class="form-control" dir="rtl"
                                    value="{{ $page->sections['hero']['button']['ar'] ?? '' }}">
                                @error('hero.button.ar')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Background Image') }}</label>
                                <input type="file" name="hero[background]" class="form-control">
                                @if (!empty($page->sections['hero']['background']))
                                    <img src="{{ asset('storage/' . $page->sections['hero']['background']) }}"
                                        class="mt-2 " style="max-height: 100px">
                                @endif
                                @error('hero.background')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Features Section -->
            <div class="card mb-4">
                <div class="card-header bg-light mb-3">
                    <h5 class="card-title">{{ __('Features') }}</h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Title (Arabic)') }}</label>
                                <input type="text" name="features[title][ar]" class="form-control" dir="rtl"
                                    value="{{ $page->sections['features']['title']['ar'] ?? '' }}">
                                @error('features.title.ar')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Subtitle (Arabic)') }}</label>
                                <input type="text" name="features[subtitle][ar]" class="form-control" dir="rtl"
                                    value="{{ $page->sections['features']['subtitle']['ar'] ?? '' }}">
                                @error('features.subtitle.ar')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Title (English)') }}</label>
                                <input type="text" name="features[title][en]" class="form-control"
                                    value="{{ $page->sections['features']['title']['en'] ?? '' }}">
                                @error('features.title.en')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Subtitle (English)') }}</label>
                                <input type="text" name="features[subtitle][en]" class="form-control"
                                    value="{{ $page->sections['features']['subtitle']['en'] ?? '' }}">
                                @error('features.subtitle.en')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    @foreach (['feature_1', 'feature_2', 'feature_3', 'feature_4'] as $feature)
                        <div class="border p-3 mb-3 rounded">
                            <h6>{{ __('Feature') }} {{ substr($feature, -1) }}</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">{{ __('Title (Arabic)') }}</label>
                                        <input type="text" name="features[{{ $feature }}][title][ar]"
                                            class="form-control @error('features.' . $feature . '.title.ar') is-invalid @enderror"
                                            dir="rtl"
                                            value="{{ $page->sections['features'][$feature]['title']['ar'] ?? '' }}">
                                        @error('features.' . $feature . '.title.ar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label">{{ __('Subtitle (Arabic)') }}</label>
                                        <input type="text" name="features[{{ $feature }}][subtitle][ar]"
                                            class="form-control @error('features.' . $feature . '.subtitle.ar') is-invalid @enderror"
                                            dir="rtl"
                                            value="{{ $page->sections['features'][$feature]['subtitle']['ar'] ?? '' }}">
                                        @error('features.' . $feature . '.subtitle.ar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">{{ __('Title (English)') }}</label>
                                        <input type="text" name="features[{{ $feature }}][title][en]"
                                            class="form-control @error('features.' . $feature . '.title.en') is-invalid @enderror"
                                            value="{{ $page->sections['features'][$feature]['title']['en'] ?? '' }}">
                                        @error('features.' . $feature . '.title.en')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label">{{ __('Subtitle (English)') }}</label>
                                        <input type="text" name="features[{{ $feature }}][subtitle][en]"
                                            class="form-control @error('features.' . $feature . '.subtitle.en') is-invalid @enderror"
                                            value="{{ $page->sections['features'][$feature]['subtitle']['en'] ?? '' }}">
                                        @error('features.' . $feature . '.subtitle.en')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Why Us Section -->
            <div class="card mb-4">
                <div class="card-header bg-light mb-3">
                    <h5 class="card-title">{{ __('Why Choose Us') }}</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Title (Arabic)') }}</label>
                                <input type="text" name="why_us[title][ar]"
                                    class="form-control @error('why_us.title.ar') is-invalid @enderror" dir="rtl"
                                    value="{{ $page->sections['why_us']['title']['ar'] ?? '' }}">
                                @error('why_us.title.ar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Subtitle (Arabic)') }}</label>
                                <input type="text" name="why_us[subtitle][ar]"
                                    class="form-control @error('why_us.subtitle.ar') is-invalid @enderror" dir="rtl"
                                    value="{{ $page->sections['why_us']['subtitle']['ar'] ?? '' }}">
                                @error('why_us.subtitle.ar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Title (English)') }}</label>
                                <input type="text" name="why_us[title][en]"
                                    class="form-control @error('why_us.title.en') is-invalid @enderror"
                                    value="{{ $page->sections['why_us']['title']['en'] ?? '' }}">
                                @error('why_us.title.en')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Subtitle (English)') }}</label>
                                <input type="text" name="why_us[subtitle][en]"
                                    class="form-control @error('why_us.subtitle.en') is-invalid @enderror"
                                    value="{{ $page->sections['why_us']['subtitle']['en'] ?? '' }}">
                                @error('why_us.subtitle.en')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    @foreach (['why_us_1', 'why_us_2', 'why_us_3'] as $reason)
                        <div class="border p-3 mb-3 rounded">
                            <h6>{{ __('Reason') }} {{ substr($reason, -1) }}</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">{{ __('Title (Arabic)') }}</label>
                                        <input type="text" name="why_us[{{ $reason }}][title][ar]"
                                            class="form-control @error('why_us.' . $reason . '.title.ar') is-invalid @enderror"
                                            dir="rtl"
                                            value="{{ $page->sections['why_us'][$reason]['title']['ar'] ?? '' }}">
                                        @error('why_us.' . $reason . '.title.ar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label">{{ __('Text (Arabic)') }}</label>
                                        <textarea name="why_us[{{ $reason }}][text][ar]"
                                            class="form-control @error('why_us.' . $reason . '.text.ar') is-invalid @enderror" dir="rtl" rows="3">{{ $page->sections['why_us'][$reason]['text']['ar'] ?? '' }}</textarea>
                                        @error('why_us.' . $reason . '.text.ar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">{{ __('Title (English)') }}</label>
                                        <input type="text" name="why_us[{{ $reason }}][title][en]"
                                            class="form-control @error('why_us.' . $reason . '.title.en') is-invalid @enderror"
                                            value="{{ $page->sections['why_us'][$reason]['title']['en'] ?? '' }}">
                                        @error('why_us.' . $reason . '.title.en')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label">{{ __('Text (English)') }}</label>
                                        <textarea name="why_us[{{ $reason }}][text][en]"
                                            class="form-control @error('why_us.' . $reason . '.text.en') is-invalid @enderror" rows="3">{{ $page->sections['why_us'][$reason]['text']['en'] ?? '' }}</textarea>
                                        @error('why_us.' . $reason . '.text.en')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- How It Works Section -->
            <div class="card mb-4">
                <div class="card-header bg-light mb-3">
                    <h5 class="card-title">{{ __('How It Works') }}</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Title (Arabic)') }}</label>
                                <input type="text" name="how_it_works[title][ar]" class="form-control" dir="rtl"
                                    value="{{ $page->sections['how_it_works']['title']['ar'] ?? '' }}">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Subtitle (Arabic)') }}</label>
                                <input type="text" name="how_it_works[subtitle][ar]" class="form-control"
                                    dir="rtl"
                                    value="{{ $page->sections['how_it_works']['subtitle']['ar'] ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Title (English)') }}</label>
                                <input type="text" name="how_it_works[title][en]" class="form-control"
                                    value="{{ $page->sections['how_it_works']['title']['en'] ?? '' }}">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Subtitle (English)') }}</label>
                                <input type="text" name="how_it_works[subtitle][en]" class="form-control"
                                    value="{{ $page->sections['how_it_works']['subtitle']['en'] ?? '' }}">
                            </div>
                        </div>
                    </div>

                    @foreach (['step_1', 'step_2', 'step_3', 'step_4'] as $step)
                        <div class="border p-3 mb-3 rounded">
                            <h6>{{ __('Step') }} {{ substr($step, -1) }}</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">{{ __('Title (Arabic)') }}</label>
                                        <input type="text" name="how_it_works[{{ $step }}][title][ar]"
                                            class="form-control @error('how_it_works.' . $step . '.title.ar') is-invalid @enderror"
                                            dir="rtl"
                                            value="{{ $page->sections['how_it_works'][$step]['title']['ar'] ?? '' }}">
                                        @error('how_it_works.' . $step . '.title.ar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label">{{ __('Subtitle (Arabic)') }}</label>
                                        <input type="text" name="how_it_works[{{ $step }}][subtitle][ar]"
                                            class="form-control @error('how_it_works.' . $step . '.subtitle.ar') is-invalid @enderror"
                                            dir="rtl"
                                            value="{{ $page->sections['how_it_works'][$step]['subtitle']['ar'] ?? '' }}">
                                        @error('how_it_works.' . $step . '.subtitle.ar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">{{ __('Title (English)') }}</label>
                                        <input type="text" name="how_it_works[{{ $step }}][title][en]"
                                            class="form-control @error('how_it_works.' . $step . '.title.en') is-invalid @enderror"
                                            value="{{ $page->sections['how_it_works'][$step]['title']['en'] ?? '' }}">
                                        @error('how_it_works.' . $step . '.title.en')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label">{{ __('Subtitle (English)') }}</label>
                                        <input type="text" name="how_it_works[{{ $step }}][subtitle][en]"
                                            class="form-control @error('how_it_works.' . $step . '.subtitle.en') is-invalid @enderror"
                                            value="{{ $page->sections['how_it_works'][$step]['subtitle']['en'] ?? '' }}">
                                        @error('how_it_works.' . $step . '.subtitle.en')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Counter Section -->
            <div class="card mb-4">
                <div class="card-header bg-light mb-3">
                    <h5 class="card-title">{{ __('Counter Section') }}</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Title (Arabic)') }}</label>
                                <input type="text" name="counter[title][ar]" class="form-control" dir="rtl"
                                    value="{{ $page->sections['counter']['title']['ar'] ?? '' }}">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Subtitle (Arabic)') }}</label>
                                <input type="text" name="counter[subtitle][ar]" class="form-control" dir="rtl"
                                    value="{{ $page->sections['counter']['subtitle']['ar'] ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Title (English)') }}</label>
                                <input type="text" name="counter[title][en]" class="form-control"
                                    value="{{ $page->sections['counter']['title']['en'] ?? '' }}">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Subtitle (English)') }}</label>
                                <input type="text" name="counter[subtitle][en]" class="form-control"
                                    value="{{ $page->sections['counter']['subtitle']['en'] ?? '' }}">
                            </div>
                        </div>
                    </div>

                    @foreach (['counter_1', 'counter_2', 'counter_3', 'counter_4'] as $counter)
                        <div class="border p-3 mb-3 rounded">
                            <h6>{{ __('Counter') }} {{ substr($counter, -1) }}</h6>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label">{{ __('Title (Arabic)') }}</label>
                                        <input type="text" name="counter[{{ $counter }}][title][ar]"
                                            class="form-control @error('counter.' . $counter . '.title.ar') is-invalid @enderror"
                                            dir="rtl"
                                            value="{{ $page->sections['counter'][$counter]['title']['ar'] ?? '' }}">
                                        @error('counter.' . $counter . '.title.ar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label">{{ __('Title (English)') }}</label>
                                        <input type="text" name="counter[{{ $counter }}][title][en]"
                                            class="form-control @error('counter.' . $counter . '.title.en') is-invalid @enderror"
                                            value="{{ $page->sections['counter'][$counter]['title']['en'] ?? '' }}">
                                        @error('counter.' . $counter . '.title.en')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label">{{ __('Value') }}</label>
                                        <input type="number" name="counter[{{ $counter }}][value]"
                                            class="form-control @error('counter.' . $counter . '.value') is-invalid @enderror"
                                            value="{{ $page->sections['counter'][$counter]['value'] ?? '' }}">
                                        @error('counter.' . $counter . '.value')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- FAQs Section -->
            <div class="card mb-4">
                <div class="card-header bg-light mb-3">
                    <h5 class="card-title">{{ __('FAQs Section') }}</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Title (Arabic)') }}</label>
                                <input type="text" name="faqs[title][ar]" class="form-control" dir="rtl"
                                    value="{{ $page->sections['faqs']['title']['ar'] ?? '' }}">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Subtitle (Arabic)') }}</label>
                                <input type="text" name="faqs[subtitle][ar]" class="form-control" dir="rtl"
                                    value="{{ $page->sections['faqs']['subtitle']['ar'] ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Title (English)') }}</label>
                                <input type="text" name="faqs[title][en]" class="form-control"
                                    value="{{ $page->sections['faqs']['title']['en'] ?? '' }}">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Subtitle (English)') }}</label>
                                <input type="text" name="faqs[subtitle][en]" class="form-control"
                                    value="{{ $page->sections['faqs']['subtitle']['en'] ?? '' }}">
                            </div>
                        </div>
                    </div>

                    @foreach (['faq_1', 'faq_2', 'faq_3', 'faq_4'] as $faq)
                        <div class="border p-3 mb-3 rounded">
                            <h6>{{ __('FAQ') }} {{ substr($faq, -1) }}</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">{{ __('Question (Arabic)') }}</label>
                                        <input type="text" name="faqs[{{ $faq }}][title][ar]"
                                            class="form-control @error('faqs.' . $faq . '.title.ar') is-invalid @enderror"
                                            dir="rtl"
                                            value="{{ $page->sections['faqs'][$faq]['title']['ar'] ?? '' }}">
                                        @error('faqs.' . $faq . '.title.ar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label">{{ __('Answer (Arabic)') }}</label>
                                        <textarea name="faqs[{{ $faq }}][subtitle][ar]"
                                            class="form-control @error('faqs.' . $faq . '.subtitle.ar') is-invalid @enderror" dir="rtl" rows="3">{{ $page->sections['faqs'][$faq]['subtitle']['ar'] ?? '' }}</textarea>
                                        @error('faqs.' . $faq . '.subtitle.ar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">{{ __('Question (English)') }}</label>
                                        <input type="text" name="faqs[{{ $faq }}][title][en]"
                                            class="form-control @error('faqs.' . $faq . '.title.en') is-invalid @enderror"
                                            value="{{ $page->sections['faqs'][$faq]['title']['en'] ?? '' }}">
                                        @error('faqs.' . $faq . '.title.en')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label">{{ __('Answer (English)') }}</label>
                                        <textarea name="faqs[{{ $faq }}][subtitle][en]"
                                            class="form-control @error('faqs.' . $faq . '.subtitle.en') is-invalid @enderror" rows="3">{{ $page->sections['faqs'][$faq]['subtitle']['en'] ?? '' }}</textarea>
                                        @error('faqs.' . $faq . '.subtitle.en')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Testimonials Section -->
            <div class="card mb-4">
                <div class="card-header bg-light mb-3">
                    <h5 class="card-title">{{ __('Testimonials Section') }}</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Title (Arabic)') }}</label>
                                <input type="text" name="testimonials[title][ar]" class="form-control" dir="rtl"
                                    value="{{ $page->sections['testimonials']['title']['ar'] ?? '' }}">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Subtitle (Arabic)') }}</label>
                                <input type="text" name="testimonials[subtitle][ar]" class="form-control"
                                    dir="rtl"
                                    value="{{ $page->sections['testimonials']['subtitle']['ar'] ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Title (English)') }}</label>
                                <input type="text" name="testimonials[title][en]" class="form-control"
                                    value="{{ $page->sections['testimonials']['title']['en'] ?? '' }}">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Subtitle (English)') }}</label>
                                <input type="text" name="testimonials[subtitle][en]" class="form-control"
                                    value="{{ $page->sections['testimonials']['subtitle']['en'] ?? '' }}">
                            </div>
                        </div>
                    </div>

                    @foreach (['testimonial_1', 'testimonial_2', 'testimonial_3'] as $testimonial)
                        <div class="border p-3 mb-3 rounded">
                            <h6>{{ __('Testimonial') }} {{ substr($testimonial, -1) }}</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">{{ __('Name (Arabic)') }}</label>
                                        <input type="text" name="testimonials[{{ $testimonial }}][title][ar]"
                                            class="form-control @error('testimonials.' . $testimonial . '.title.ar') is-invalid @enderror"
                                            dir="rtl"
                                            value="{{ $page->sections['testimonials'][$testimonial]['title']['ar'] ?? '' }}">
                                        @error('testimonials.' . $testimonial . '.title.ar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label">{{ __('Text (Arabic)') }}</label>
                                        <textarea name="testimonials[{{ $testimonial }}][text][ar]"
                                            class="form-control @error('testimonials.' . $testimonial . '.text.ar') is-invalid @enderror" dir="rtl"
                                            rows="3">{{ $page->sections['testimonials'][$testimonial]['text']['ar'] ?? '' }}</textarea>
                                        @error('testimonials.' . $testimonial . '.text.ar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">{{ __('Name (English)') }}</label>
                                        <input type="text" name="testimonials[{{ $testimonial }}][title][en]"
                                            class="form-control @error('testimonials.' . $testimonial . '.title.en') is-invalid @enderror"
                                            value="{{ $page->sections['testimonials'][$testimonial]['title']['en'] ?? '' }}">
                                        @error('testimonials.' . $testimonial . '.title.en')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label">{{ __('Text (English)') }}</label>
                                        <textarea name="testimonials[{{ $testimonial }}][text][en]"
                                            class="form-control @error('testimonials.' . $testimonial . '.text.en') is-invalid @enderror" rows="3">{{ $page->sections['testimonials'][$testimonial]['text']['en'] ?? '' }}</textarea>
                                        @error('testimonials.' . $testimonial . '.text.en')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label">{{ __('Image') }}</label>
                                        <input type="file" name="testimonials[{{ $testimonial }}][image]"
                                            class="form-control @error('testimonials.' . $testimonial . '.image') is-invalid @enderror">
                                        @error('testimonials.' . $testimonial . '.image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @if (!empty($page->sections['testimonials'][$testimonial]['image']))
                                            <img src="{{ asset('storage/' . $page->sections['testimonials'][$testimonial]['image']) }}"
                                                class="mt-2" style="max-height: 100px">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Get Started Now Section -->
            <div class="card mb-4">
                <div class="card-header bg-light mb-3">
                    <h5 class="card-title">{{ __('Get Started Now Section') }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Title (Arabic)') }}</label>
                                <input type="text" name="get_started_now[title][ar]"
                                    class="form-control @error('get_started_now.title.ar') is-invalid @enderror"
                                    dir="rtl"
                                    value="{{ $page->sections['get_started_now']['title']['ar'] ?? '' }}">
                                @error('get_started_now.title.ar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Subtitle (Arabic)') }}</label>
                                <input type="text" name="get_started_now[subtitle][ar]"
                                    class="form-control @error('get_started_now.subtitle.ar') is-invalid @enderror"
                                    dir="rtl"
                                    value="{{ $page->sections['get_started_now']['subtitle']['ar'] ?? '' }}">
                                @error('get_started_now.subtitle.ar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Button Text (Arabic)') }}</label>
                                <input type="text" name="get_started_now[button][ar]"
                                    class="form-control @error('get_started_now.button.ar') is-invalid @enderror"
                                    dir="rtl"
                                    value="{{ $page->sections['get_started_now']['button']['ar'] ?? '' }}">
                                @error('get_started_now.button.ar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Title (English)') }}</label>
                                <input type="text" name="get_started_now[title][en]"
                                    class="form-control @error('get_started_now.title.en') is-invalid @enderror"
                                    value="{{ $page->sections['get_started_now']['title']['en'] ?? '' }}">
                                @error('get_started_now.title.en')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Subtitle (English)') }}</label>
                                <input type="text" name="get_started_now[subtitle][en]"
                                    class="form-control @error('get_started_now.subtitle.en') is-invalid @enderror"
                                    value="{{ $page->sections['get_started_now']['subtitle']['en'] ?? '' }}">
                                @error('get_started_now.subtitle.en')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Button Text (English)') }}</label>
                                <input type="text" name="get_started_now[button][en]"
                                    class="form-control @error('get_started_now.button.en') is-invalid @enderror"
                                    value="{{ $page->sections['get_started_now']['button']['en'] ?? '' }}">
                                @error('get_started_now.button.en')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Section -->
            <div class="card mb-4">
                <div class="card-header bg-light mb-3">
                    <h5 class="card-title">{{ __('Contact Section') }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Title (Arabic)') }}</label>
                                <input type="text" name="contact[title][ar]" class="form-control" dir="rtl"
                                    value="{{ $page->sections['contact']['title']['ar'] ?? '' }}">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Subtitle (Arabic)') }}</label>
                                <input type="text" name="contact[subtitle][ar]" class="form-control" dir="rtl"
                                    value="{{ $page->sections['contact']['subtitle']['ar'] ?? '' }}">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Button Text (Arabic)') }}</label>
                                <input type="text" name="contact[button][ar]" class="form-control" dir="rtl"
                                    value="{{ $page->sections['contact']['button']['ar'] ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Title (English)') }}</label>
                                <input type="text" name="contact[title][en]" class="form-control"
                                    value="{{ $page->sections['contact']['title']['en'] ?? '' }}">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Subtitle (English)') }}</label>
                                <input type="text" name="contact[subtitle][en]" class="form-control"
                                    value="{{ $page->sections['contact']['subtitle']['en'] ?? '' }}">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Button Text (English)') }}</label>
                                <input type="text" name="contact[button][en]" class="form-control"
                                    value="{{ $page->sections['contact']['button']['en'] ?? '' }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Services Section -->
            <div class="card mb-4">
                <div class="card-header bg-light mb-3">
                    <h5 class="card-title">{{ __('Services Section') }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Title (Arabic)') }}</label>
                                <input type="text" name="services[title][ar]" class="form-control" dir="rtl"
                                    value="{{ $page->sections['services']['title']['ar'] ?? '' }}">
                                @error('services.title.ar')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Subtitle (Arabic)') }}</label>
                                <input type="text" name="services[subtitle][ar]" class="form-control" dir="rtl"
                                    value="{{ $page->sections['services']['subtitle']['ar'] ?? '' }}">
                                @error('services.subtitle.ar')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Title (English)') }}</label>
                                <input type="text" name="services[title][en]" class="form-control"
                                    value="{{ $page->sections['services']['title']['en'] ?? '' }}">
                                @error('services.title.en')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Subtitle (English)') }}</label>
                                <input type="text" name="services[subtitle][en]" class="form-control"
                                    value="{{ $page->sections['services']['subtitle']['en'] ?? '' }}">
                                @error('services.subtitle.en')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Order Now Button (Arabic)') }}</label>
                                <input type="text" name="services[order_now][ar]" class="form-control" dir="rtl"
                                    value="{{ $page->sections['services']['order_now']['ar'] ?? '' }}">
                                @error('services.order_now.ar')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Order Now Button (English)') }}</label>
                                <input type="text" name="services[order_now][en]" class="form-control"
                                    value="{{ $page->sections['services']['order_now']['en'] ?? '' }}">
                                @error('services.order_now.en')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('All Services Button (Arabic)') }}</label>
                                <input type="text" name="services[all_services][ar]" class="form-control" dir="rtl"
                                    value="{{ $page->sections['services']['all_services']['ar'] ?? '' }}">
                                @error('services.all_services.ar')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('All Services Button (English)') }}</label>
                                <input type="text" name="services[all_services][en]" class="form-control"
                                    value="{{ $page->sections['services']['all_services']['en'] ?? '' }}">
                                @error('services.all_services.en')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Get Started Button (Arabic)') }}</label>
                                <input type="text" name="services[get_started][ar]" class="form-control" dir="rtl"
                                    value="{{ $page->sections['services']['get_started']['ar'] ?? '' }}">
                                @error('services.get_started.ar')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Get Started Button (English)') }}</label>
                                <input type="text" name="services[get_started][en]" class="form-control"
                                    value="{{ $page->sections['services']['get_started']['en'] ?? '' }}">
                                @error('services.get_started.en')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    {{ __('Save Changes') }}
                    <i class="bi bi-check-lg ms-2"></i>
                </button>
            </div>
        </form>
    </div>
@endsection

@section('styles')
    <style>
        .card {
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }
    </style>
@endsection
