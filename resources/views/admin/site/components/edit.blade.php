<div class="component-item card mb-3 ">
    <div class="card-header d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">{{ ucfirst($component->type) }} - {{ $component->key }}</h5>
    </div>
    <div class="card-body shadow-sm">
        <div class="row">
                {{-- @dd($component) --}}
            <!-- English Content -->
            <div class="col-md-6">
                <h6> {{__('English Content')}}</h6>
                @if ($component->type === 'image')
                    <div class="form-group mb-3">
                        <div class="input-group">
                            <div class="d-flex align-items-center border rounded-3 w-100">
                                <label for="components[{{ $component->id }}][value]" class="btn btn-outline-secondary rounded-end-0">
                                    {{ __('Browse') }}
                                </label>
                                <input type="text" id="file-name-{{ $component->id }}" class="form-control border-0" value="{{ $component->value  ?? __('No Image Selected') }}" readonly>
                            </div>
                            <input type="file" id="components[{{ $component->id }}][value]" name="components[{{ $component->id }}][value]" class="form-control d-none" accept="image/*" onchange="displayFileName(this, {{ $component->id }})">
                        </div>
                        @if ($component->value)
                            <img src="{{ asset('storage/' . $component->value) }}" class="img-thumbnail mt-2" style="max-height: 100px" alt="{{ $component->attributes['alt'] ?? '' }}">
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label>{{ __('Alt Text') }}</label>
                        <input type="text" name="components[{{ $component->id }}][attributes][alt]" class="form-control" value="{{ $component->attributes['alt'] ?? '' }}">
                    </div>
                @else
                    <div class="form-group mb-3">
                        <label> {{__('Value')}}</label>
                        @if (in_array($component->type, ['text', 'button']))
                            <input type="text" name="components[{{ $component->id }}][value]" class="form-control"
                                value="{{ $component->value }}">
                        @else
                            <textarea name="components[{{ $component->id }}][value]" class="form-control rich-text" rows="3">{{ $component->value }}</textarea>
                        @endif
                    </div>
                @endif

                @if ($component->attributes)
                {{-- @dd($component->attributes) --}}
                    @foreach ($component->attributes as $key => $value)
                        <div class="form-group mb-3">
                            <label>{{ ucfirst($key) }}</label>
                            <input type="text"

                                name="components[{{ $component->id }}][attributes][{{ $key }}]"
                                class="form-control" value="{{ $value }}">
                        </div>
                    @endforeach
                @endif
            </div>

            <!-- Arabic Content -->
            <div class="col-md-6">
                <h6> {{__('Arabic Content')}}</h6>
                @if ($component->type === 'image')
                    <div class="form-group mb-3">
                        <label>{{ __('Alt Text (Arabic)') }}</label>
                        <input type="text" name="components[{{ $component->id }}][attributes_ar][alt]" class="form-control" value="{{ json_decode($component->translate('attributes', 'ar'), true)['alt'] ?? '' }}" dir="rtl">
                    </div>
                @else
                    <div class="form-group mb-3">
                        <label> {{__('Value (Arabic)')}}</label>
                        @if (in_array($component->type, ['text', 'button']))
                            <input type="text" name="components[{{ $component->id }}][value_ar]" class="form-control"
                                value="{{ $component->translate('value', 'ar') }}" dir="rtl">
                        @else
                            <textarea name="components[{{ $component->id }}][value_ar]" class="form-control rich-text" rows="3"
                                dir="rtl">{{ $component->translate('value', 'ar') }}</textarea>
                        @endif
                    </div>

                    @if ($component->attributes)
                        @foreach ($component->attributes as $key => $value)
                            <div class="form-group mb-3">
                                <label>{{ ucfirst($key) }} ({{__('Arabic')}})</label>
                                <input type="text"
                                    name="components[{{ $component->id }}][attributes_ar][{{ $key }}]"
                                    class="form-control"
                                    value="{{ json_decode($component->translate('attributes', 'ar'), true)[$key] ?? '' }}"
                                    dir="rtl">
                            </div>
                        @endforeach
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    function displayFileName(input, id) {
        const fileName = input.files[0] ? input.files[0].name : '{{ __('No file chosen') }}';
        const fileNameElement = document.getElementById('file-name-' + id);
        if (fileNameElement) {
            fileNameElement.value = fileName;
        }
    }
</script>
