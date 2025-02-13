<div class="card mb-4">
    <div class="card-header bg-light mb-3">
        <h5 class="card-title">{{ __('Content Section') }}</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                {{-- @dd($page->sections['content']['content']['en']) --}}
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('Content (English)') }}</label>
                    @include('partials.text-editor', ['inputName' => 'sections[content][en]', 'content' => $page->sections['content']['en'] ?? '', 'dir' => 'ltr'])
                    {{-- <textarea name="sections[content][content][en]" class="form-control" rows="5">{{ $page->sections['content']['en'] ?? '' }}</textarea> --}}
                    @error('sections.content.content.en')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="form-group mb-3" dir="rtl">
                    <label class="form-label">{{ __('Content (Arabic)') }}</label>
                    @include('partials.text-editor', ['inputName' => 'sections[content][ar]', 'content' => $page->sections['content']['ar'] ?? '', 'dir' => 'rtl'])
                    {{-- <textarea name="sections[content][content][ar]" class="form-control" dir="rtl" rows="5">{{ $page->sections['content']['ar'] ?? '' }}</textarea> --}}
                    @error('sections.content.content.ar')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>
