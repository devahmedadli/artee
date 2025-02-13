<div class="card mb-4">
    <div class="card-header bg-light mb-3">
        <h5 class="card-title">{{ __('Page Details') }}</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('Title (English)') }}</label>
                    <input type="text" name="name[en]" class="form-control" value="{{ $page->name['en'] ?? '' }}">
                    @error('name.en')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('Title (Arabic)') }}</label>
                    <input type="text" name="name[ar]" class="form-control" dir="rtl" value="{{ $page->name['ar'] ?? '' }}">
                    @error('name.ar')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('Description (English)') }}</label>
                    <textarea name="description[en]" class="form-control">{{ $page->description['en'] ?? '' }}</textarea>
                    @error('description.en')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-12">
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