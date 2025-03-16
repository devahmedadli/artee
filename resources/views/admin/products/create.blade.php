@extends('layouts.admin')
@section('title', __('New Product'))
@section('content')
    <div class="container-fluid">
        <form action="{{ route('products.store') }}" method="post" class="row g-4" enctype="multipart/form-data">
            @csrf
            @include('partials.errors')
            <div class="card shadow-sm">
                <div class="card-header bg-light py-3 mb-4">
                    <h5 class="mb-0"> {{ __('Basic Information') }}</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-8 row">
                            <div class="col-md-6 form-group mb-3">
                                <label for="ar_name" class="form-label fw-bold"> {{ __('Product Name (Arabic)') }}</label>
                                <input type="text" class="form-control" id="ar_name" name="ar_name" required>
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="en_name" class="form-label fw-bold"> {{ __('Product Name (English)') }}</label>
                                <input type="text" class="form-control" id="en_name" name="en_name" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="base_price" class="form-label fw-bold"> {{ __('Base Price') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control" id="base_price" name="base_price"
                                        step="0.01" required>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="ar_description" class="form-label fw-bold">
                                    {{ __('Product Description (Arabic)') }}</label>
                                <textarea class="form-control" id="ar_description" name="ar_description" rows="4"></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="en_description" class="form-label fw-bold">
                                    {{ __('Product Description (English)') }}</label>
                                <textarea class="form-control" id="en_description" name="en_description" rows="4"></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" id="active" name="active" checked>
                                    <label class="form-check-label" for="active"> {{ __('Active Product') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex flex-column justify-content-center align-items-center">
                            <input type="file" class="form-control d-none" id="image" name="image" accept="image/*"
                                required onchange="previewImage(this)">
                            <div id="imagePlaceholder" class="mb-2"
                                style="cursor: pointer; background-color: #f0f0f0; width: 200px; height: 200px; display: flex; align-items: center; justify-content: center; background-size: cover; background-position: center;">
                                <i class="bi bi-image" style="font-size: 50px;"></i>
                            </div>
                            <label for="image" class="form-label fw-bold text-muted"> {{ __('Product Image') }}</label>
                        </div>

                    </div>
                </div>
            </div>
            <div class="card shadow-sm">
                <div class="card-header bg-light py-3 d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0"> {{ __('Product Options') }}</h5>
                    <button type="button" class="btn btn-primary btn-sm" id="addOption">
                        <i class="bi bi-plus"></i> {{ __('Add Option') }}
                    </button>
                </div>
                <div class="card-body">
                    <div id="optionsContainer"></div>
                </div>
            </div>

            <div class="col-12 text-center">
                <button type="submit" class="btn btn-success px-5">
                    <i class="bi bi-save me-2"></i> {{ __('Save Product') }}
                </button>
            </div>
        </form>
    </div>

    <!-- Option Template -->
    <template id="optionTemplate">
        <div class="option-group border rounded p-3 mb-3 bg-light">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="mb-0"> {{ __('New Option') }}</h6>
                <button type="button" class="btn btn-danger btn-sm remove-option">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
            <div class="mb-3 row">
                <div class="col-md-6 form-group mb-3">
                    <label for="ar_option_name" class="form-label fw-bold"> {{ __('Option Name (Arabic)') }}</label>
                    <input type="text" class="form-control" name="options[__INDEX__][ar_name]"
                        placeholder=" {{ __('Option Name (Example: Size, Color)') }}" required>
                </div>
                <div class="col-md-6 form-group mb-3">
                    <label for="en_option_name" class="form-label fw-bold"> {{ __('Option Name (English)') }}</label>
                    <input type="text" class="form-control" name="options[__INDEX__][en_name]"
                        placeholder=" {{ __('Option Name (Example: Size, Color)') }}" required>
                </div>
            </div>
            <div class="values-container">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" name="options[__INDEX__][values][0][ar_value]"
                        placeholder=" {{ __('Value Name (Arabic)') }}" required>
                    <input type="text" class="form-control" name="options[__INDEX__][values][0][en_value]"
                        placeholder=" {{ __('Value Name (English)') }}" required>
                    <input type="number" class="form-control" name="options[__INDEX__][values][0][price]"
                        placeholder=" {{ __('Additional Price') }}" step="0.01" required>
                    <button type="button" class="btn btn-success add-value">
                        <i class="bi bi-plus"></i>
                    </button>
                    <button type="button" class="btn btn-info add-requirement" title="{{ __('Add Requirements') }}">
                        <i class="bi bi-list-check"></i>
                    </button>
                </div>
                <div class="requirements-container d-none mb-3">
                    <div class="requirements-list p-2 border-start border-end border-bottom rounded-bottom">
                        <!-- Requirements will be added here -->
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        <button type="button" class="btn btn-sm btn-primary add-new-requirement">
                            <i class="bi bi-plus-circle me-1"></i> {{ __('Add Requirement') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </template>

    <!-- Requirement Template -->
    <template id="requirementTemplate">
        <div class="requirement-item border-bottom pb-2 mb-2">
            <div class="row g-2">
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-sm" 
                        name="options[__OPTION_INDEX__][values][__VALUE_INDEX__][requirements][__REQ_INDEX__][ar_name]"
                        placeholder="{{ __('Name (Arabic)') }}" required>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-sm" 
                        name="options[__OPTION_INDEX__][values][__VALUE_INDEX__][requirements][__REQ_INDEX__][en_name]"
                        placeholder="{{ __('Name (English)') }}" required>
                </div>
                <div class="col-md-3">
                    <select class="form-select form-select-sm" 
                        name="options[__OPTION_INDEX__][values][__VALUE_INDEX__][requirements][__REQ_INDEX__][type]" required>
                        <option value="text">{{ __('Text') }}</option>
                        <option value="number">{{ __('Number') }}</option>
                        <option value="boolean">{{ __('Yes/No') }}</option>
                        <option value="file">{{ __('File') }}</option>
                        <option value="image">{{ __('Image') }}</option>
                        <option value="custom_design">{{ __('Custom Design') }}</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <div class="form-check mt-1">
                        <input class="form-check-input" type="checkbox" 
                            name="options[__OPTION_INDEX__][values][__VALUE_INDEX__][requirements][__REQ_INDEX__][required]" 
                            id="req_required___OPTION_INDEX_____VALUE_INDEX_____REQ_INDEX__" checked>
                        <label class="form-check-label small" for="req_required___OPTION_INDEX_____VALUE_INDEX_____REQ_INDEX__">
                            {{ __('Required') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-sm btn-danger remove-requirement">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    </template>

    <canvas id="canvas" style="display: none;"></canvas>
@endsection

@section('page-scripts')
    @vite('resources/js/pages/products/product-form.js')

@endsection
