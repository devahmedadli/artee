<div class="card mb-4">
    <div class="card-header bg-light mb-3">
        <h5 class="card-title">{{ __('Hero Section') }}</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('Title (English)') }}</label>
                    <input type="text" name="sections[hero][title][en]" class="form-control" 
                        value="{{ $page->sections['hero']['title']['en'] ?? '' }}">
                    @error('sections.hero.title.en')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('Title (Arabic)') }}</label>
                    <input type="text" name="sections[hero][title][ar]" class="form-control" dir="rtl"
                        value="{{ $page->sections['hero']['title']['ar'] ?? '' }}">
                    @error('sections.hero.title.ar')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('Subtitle (English)') }}</label>
                    <textarea name="sections[hero][subtitle][en]" class="form-control">{{ $page->sections['hero']['subtitle']['en'] ?? '' }}</textarea>
                    @error('sections.hero.subtitle.en')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('Subtitle (Arabic)') }}</label>
                    <textarea name="sections[hero][subtitle][ar]" class="form-control" dir="rtl">{{ $page->sections['hero']['subtitle']['ar'] ?? '' }}</textarea>
                    @error('sections.hero.subtitle.ar')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div> 