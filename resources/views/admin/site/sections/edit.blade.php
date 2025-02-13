<div class="section-content">
    <div class="row">
        <!-- English Content -->
        <div class="col-md-6">
            <h5> {{ __('English Content') }}</h5>
            <div class="form-group mb-3">
                <label> {{ __('Title') }}</label>
                <input type="text" name="sections[{{ $section->id }}][title]" class="form-control"
                    value="{{ $section->title }}">
            </div>
            <div class="form-group mb-3">
                <label> {{ __('Subtitle') }}</label>
                <input type="text" name="sections[{{ $section->id }}][subtitle]" class="form-control"
                    value="{{ $section->subtitle }}">
            </div>
        </div>

        <!-- Arabic Content -->
        <div class="col-md-6">
            <h5> {{ __('Arabic Content') }}</h5>
            <div class="form-group mb-3">
                <label> {{ __('Title (Arabic)') }}</label>
                <input type="text" name="sections[{{ $section->id }}][title_ar]" class="form-control"
                    value="{{ $section->translate('title', 'ar') }}" dir="rtl">
            </div>
            <div class="form-group mb-3">
                <label> {{ __('Subtitle (Arabic)') }}</label>
                <input type="text" name="sections[{{ $section->id }}][subtitle_ar]" class="form-control"
                    value="{{ $section->translate('subtitle', 'ar') }}" dir="rtl">
            </div>
        </div>
    </div>
</div>
