@extends('layouts.home')
@section('title', __('Product Details'))
@section('content')
    @include('partials.page-hero', [
        'title' => __('Product Details'),
        'description' => __('Our Product in more details'),
    ])

    <main class="py-5 min-vh-80">
        <div class="container">
            <div class="row" style="min-height: 500px;">
                <div class="col-md-6 order-md-2 order-1">
                    <div class="">
                        <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid" alt="Product Image">
                    </div>
                </div>
                <div class="col-md-6 order-md-1 order-2">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body">
                            <h5 class="card-title">
                                {{ __('Product Name') }}:
                                {{ $product->{app()->getLocale() . '_name'} }}
                            </h5>

                            <form id="product-order-form" action="{{ route('product.order.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">

                                <!-- Multi-step form -->
                                <div id="product-order-steps">
                                    <!-- Progress bar -->
                                    <div class="progress mb-4" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>

                                    <!-- Step indicators -->
                                    <div class="d-flex justify-content-between mb-4">
                                        <span class="step-indicator active" data-step="1">1. {{ __('Options') }}</span>
                                        <span class="step-indicator" data-step="2">2. {{ __('Requirements') }}</span>
                                        <span class="step-indicator" data-step="3">3. {{ __('Checkout') }}</span>
                                    </div>

                                    <div id="form-errors" class="d-none mb-4"></div>

                                    <!-- Step 1: Product Options -->
                                    <div class="form-step" id="step-1">
                                        @if ($product->options->count() > 0)
                                            <ul class="list-group list-group-flush mb-3">
                                                @foreach ($product->options as $option)
                                                    <li class="list-group-item">
                                                        <label class="form-label fw-bold mb-3">
                                                            {{ $option->{app()->getLocale() . '_name'} }}:
                                                        </label>
                                                        <ul class="list-group list-unstyled option-group d-flex flex-row flex-wrap"
                                                            data-option-id="{{ $option->id }}">
                                                            @foreach ($option->values as $value)
                                                                <li class="custom-radio mb-2 me-2">
                                                                    <input type="radio" class="form-check-input"
                                                                        id="option_{{ $option->id }}_{{ $value->id }}"
                                                                        name="options[{{ $option->id }}]"
                                                                        value="{{ $value->id }}"
                                                                        data-price="{{ $value->price }}"
                                                                        data-has-requirements="{{ $value->requirements && $value->requirements->count() > 0 ? 'true' : 'false' }}"
                                                                        @if ($loop->first) checked @endif>
                                                                    <label class="custom-radio-label"
                                                                        for="option_{{ $option->id }}_{{ $value->id }}">
                                                                        <span
                                                                            class="d-flex justify-content-between align-items-center">
                                                                            <span
                                                                                class="option-text me-2">{{ $value->{app()->getLocale() . '_value'} }}</span>
                                                                            @if ($value->price > 0)
                                                                                <span
                                                                                    class="price-tag">+{{ $value->price }}</span>
                                                                            @endif
                                                                        </span>
                                                                    </label>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p class="text-muted">{{ __('This product has no customizable options.') }}</p>
                                        @endif

                                        <div class="d-flex justify-content-between mt-4">
                                            <div></div>
                                            <button type="button"
                                                class="btn btn-primary next-step">{{ __('Next') }}</button>
                                        </div>
                                    </div>

                                    <!-- Step 2: Requirements -->
                                    <div class="form-step d-none" id="step-2">
                                        <div id="requirements-container">
                                            <!-- Requirements will be loaded dynamically based on selected options -->
                                            <div class="text-center py-4" id="no-requirements-message">
                                                <p>{{ __('No additional information required for your selected options.') }}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between mt-4">
                                            <button type="button"
                                                class="btn btn-secondary prev-step">{{ __('Previous') }}</button>
                                            <button type="button"
                                                class="btn btn-primary next-step">{{ __('Next') }}</button>
                                        </div>
                                    </div>

                                    <!-- Step 3: Checkout -->
                                    <div class="form-step d-none" id="step-3">
                                        <h5 class="mb-4">{{ __('Order Summary') }}</h5>

                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <h6 class="card-subtitle mb-3 text-muted">{{ __('Selected Options') }}</h6>
                                                <ul class="list-group list-group-flush" id="selected-options-summary">
                                                    <!-- Will be populated via JavaScript -->
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="customer-notes"
                                                class="form-label">{{ __('Additional Notes') }}</label>
                                            <textarea class="form-control" id="customer-notes" name="notes" rows="3"
                                                placeholder="{{ __('Any special instructions or requests?') }}"></textarea>
                                        </div>

                                        <div class="card bg-light mb-4">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h5 class="mb-0">{{ __('Total Price') }}:</h5>
                                                    <h5 class="mb-0" id="checkout-total-price">{{ $product->base_price }}
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between mt-4">
                                            <button type="button"
                                                class="btn btn-secondary prev-step">{{ __('Previous') }}</button>
                                            <button type="submit" class="btn btn-success">{{ __('Place Order') }}</button>
                                        </div>
                                    </div>
                                </div>

                                <h5 class="card-title mt-4">
                                    {{ __('Total Price') }}:
                                    <span id="total-price">{{ $product->base_price }}</span>
                                </h5>

                                <p class="card-text text-muted">
                                    {{ __('Description') }}:
                                    <br>
                                    {!! nl2br(e($product->{app()->getLocale() . '_description'})) !!}
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
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

    .custom-radio {
        position: relative;
        margin-bottom: 0.75rem;
    }

    .custom-radio input[type="radio"] {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }

    .custom-radio-label {
        display: block;
        padding: 0.75rem 1rem;
        border: 1px solid #dee2e6;
        border-radius: 0.5rem;
        background-color: #fff;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
        margin: 0;
        width: 100%;
    }

    .custom-radio input[type="radio"]:checked+.custom-radio-label {
        border-color: #007bff;
        background-color: #f8f9ff;
        box-shadow: 0 0 0 1px #007bff;
    }

    .custom-radio-label:hover {
        background-color: #f8f9fa;
        border-color: #007bff;
    }

    .custom-radio input[type="radio"]:focus+.custom-radio-label {
        outline: none;
        box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
    }

    .option-text {
        font-size: 1rem;
        color: #212529;
    }

    .price-tag {
        font-size: 0.9rem;
        color: #28a745;
        font-weight: 600;
        background-color: #e8f5e9;
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
    }

    .custom-radio input[type="radio"]:checked+.custom-radio-label .option-text {
        font-weight: 600;
        color: #007bff;
    }

    /* Multi-step form styles */
    .step-indicator {
        font-weight: 500;
        color: #6c757d;
        position: relative;
        padding-bottom: 10px;
    }

    .step-indicator.active {
        color: #007bff;
        font-weight: 600;
    }

    .step-indicator.completed {
        color: #28a745;
    }

    .step-indicator::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background-color: transparent;
    }

    .step-indicator.active::after {
        background-color: #007bff;
    }

    .step-indicator.completed::after {
        background-color: #28a745;
    }

    .requirement-group {
        background-color: #f8f9fa;
        border-radius: 0.5rem;
        padding: 1.25rem;
        margin-bottom: 1.5rem;
    }

    .requirement-group h6 {
        border-bottom: 1px solid #dee2e6;
        padding-bottom: 0.75rem;
        margin-bottom: 1.25rem;
    }

    /* Business Card Designer styles */
    .design-preview {
        min-height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #businessCardDesignerModal .modal-body {
        padding: 1.5rem;
    }

    .canvas-container {
        margin: 0 auto;
    }

    #cardCanvas {
        margin: 0 auto;
        display: block;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .form-control-color {
        width: 100%;
        height: 38px;
    }
</style>

@section('page-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Define the current locale for JavaScript to use
            const currentLocale = '{{ app()->getLocale() }}';

            // Price calculation
            const basePrice = {{ $product->base_price }};
            const optionGroups = document.querySelectorAll('.option-group');
            const totalPriceElement = document.getElementById('total-price');
            const checkoutTotalPrice = document.getElementById('checkout-total-price');

            function calculateTotalPrice() {
                let total = basePrice;

                optionGroups.forEach(group => {
                    const selectedRadio = group.querySelector('input[type="radio"]:checked');
                    if (selectedRadio) {
                        const additionalPrice = parseFloat(selectedRadio.dataset.price) || 0;
                        total += additionalPrice;
                    }
                });

                // Format the total price with 2 decimal places
                const formattedPrice = total.toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });

                totalPriceElement.textContent = formattedPrice;
                if (checkoutTotalPrice) {
                    checkoutTotalPrice.textContent = formattedPrice;
                }

                return total;
            }

            // Add event listeners to all radio inputs
            document.querySelectorAll('input[type="radio"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    calculateTotalPrice();
                    updateRequirementsStep();
                });
            });

            // Calculate initial price
            calculateTotalPrice();

            // Multi-step form navigation
            const formSteps = document.querySelectorAll('.form-step');
            const stepIndicators = document.querySelectorAll('.step-indicator');
            const progressBar = document.querySelector('.progress-bar');
            let currentStep = 1;

            // Next step buttons
            document.querySelectorAll('.next-step').forEach(button => {
                button.addEventListener('click', function() {
                    // If we're on step 1, update requirements before proceeding
                    if (currentStep === 1) {
                        updateRequirementsStep();
                    }

                    // If we're on step 2, update order summary before proceeding
                    if (currentStep === 2) {
                        updateOrderSummary();
                    }

                    // Hide current step
                    document.getElementById(`step-${currentStep}`).classList.add('d-none');

                    // Mark current step as completed
                    stepIndicators[currentStep - 1].classList.remove('active');
                    stepIndicators[currentStep - 1].classList.add('completed');

                    // Show next step
                    currentStep++;
                    document.getElementById(`step-${currentStep}`).classList.remove('d-none');
                    stepIndicators[currentStep - 1].classList.add('active');

                    // Update progress bar
                    const progress = ((currentStep - 1) / (formSteps.length - 1)) * 100;
                    progressBar.style.width = `${progress}%`;
                    progressBar.setAttribute('aria-valuenow', progress);
                });
            });

            // Previous step buttons
            document.querySelectorAll('.prev-step').forEach(button => {
                button.addEventListener('click', function() {
                    // Hide current step
                    document.getElementById(`step-${currentStep}`).classList.add('d-none');

                    // Update step indicator
                    stepIndicators[currentStep - 1].classList.remove('active');

                    // Show previous step
                    currentStep--;
                    document.getElementById(`step-${currentStep}`).classList.remove('d-none');

                    // Mark previous step as active (not completed)
                    stepIndicators[currentStep - 1].classList.remove('completed');
                    stepIndicators[currentStep - 1].classList.add('active');

                    // Update progress bar
                    const progress = ((currentStep - 1) / (formSteps.length - 1)) * 100;
                    progressBar.style.width = `${progress}%`;
                    progressBar.setAttribute('aria-valuenow', progress);
                });
            });

            // Function to update requirements step based on selected options
            function updateRequirementsStep() {
                const requirementsContainer = document.getElementById('requirements-container');
                const noRequirementsMessage = document.getElementById('no-requirements-message');
                let hasRequirements = false;

                // Clear previous requirements
                requirementsContainer.innerHTML = '';
                requirementsContainer.appendChild(noRequirementsMessage);

                // Get all selected options
                const selectedOptions = [];
                optionGroups.forEach(group => {
                    const selectedRadio = group.querySelector('input[type="radio"]:checked');
                    if (selectedRadio && selectedRadio.dataset.hasRequirements === 'true') {
                        hasRequirements = true;
                        const optionId = group.dataset.optionId;
                        const valueId = selectedRadio.value;
                        const optionName = selectedRadio.closest('li.list-group-item').querySelector(
                            'label.form-label').textContent.trim();
                        const valueName = selectedRadio.nextElementSibling.querySelector('.option-text')
                            .textContent.trim();

                        selectedOptions.push({
                            optionId,
                            valueId,
                            optionName,
                            valueName
                        });
                    }
                });

                if (hasRequirements) {
                    // Hide no requirements message
                    noRequirementsMessage.classList.add('d-none');

                    // Fetch requirements for selected options
                    fetch(`/api/product-options/requirements?options=${JSON.stringify(selectedOptions)}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.requirements && data.requirements.length > 0) {
                                // Create requirements form fields
                                data.requirements.forEach(requirement => {
                                    const requirementGroup = document.createElement('div');
                                    requirementGroup.className = 'requirement-group';

                                    let inputHtml = '';
                                    const requiredAttr = requirement.required ? 'required' : '';

                                    switch (requirement.type) {
                                        case 'text':
                                            inputHtml = `
                                                <div class="mb-3">
                                                    <label for="req_${requirement.id}" class="form-label">${requirement[currentLocale + '_name']}</label>
                                                    <input type="text" class="form-control" id="req_${requirement.id}" 
                                                        name="requirements[${requirement.id}]" ${requiredAttr}>
                                                </div>
                                            `;
                                            break;
                                        case 'number':
                                            inputHtml = `
                                                <div class="mb-3">
                                                    <label for="req_${requirement.id}" class="form-label">${requirement[currentLocale + '_name']}</label>
                                                    <input type="number" class="form-control" id="req_${requirement.id}" 
                                                        name="requirements[${requirement.id}]" ${requiredAttr}>
                                                </div>
                                            `;
                                            break;
                                        case 'boolean':
                                            inputHtml = `
                                                <div class="mb-3 form-check">
                                                    <input type="checkbox" class="form-check-input" id="req_${requirement.id}" 
                                                        name="requirements[${requirement.id}]" value="1">
                                                    <label class="form-check-label" for="req_${requirement.id}">${requirement[currentLocale + '_name']}</label>
                                                </div>
                                            `;
                                            break;
                                        case 'file':
                                            inputHtml = `
                                                <div class="mb-3">
                                                    <label for="req_${requirement.id}" class="form-label">${requirement[currentLocale + '_name']}</label>
                                                    <input type="file" class="form-control" id="req_${requirement.id}" 
                                                        name="requirements[${requirement.id}]" ${requiredAttr}>
                                                </div>
                                            `;
                                            break;
                                        case 'image':
                                            inputHtml = `
                                                <div class="mb-3">
                                                    <label for="req_${requirement.id}" class="form-label">${requirement[currentLocale + '_name']}</label>
                                                    <input type="file" class="form-control" id="req_${requirement.id}" 
                                                        name="requirements[${requirement.id}]" accept="image/*" ${requiredAttr}>
                                                </div>
                                            `;
                                            break;
                                        case 'custom_design':
                                            inputHtml = `
                                                <div class="mb-3">
                                                    <label for="req_${requirement.id}" class="form-label">${requirement[currentLocale + '_name']}</label>
                                                    <div class="alert alert-info">
                                                        {{ __('Design your business card using our online designer') }}
                                                    </div>
                                                    <input type="hidden" id="req_${requirement.id}" name="requirements[${requirement.id}]" ${requiredAttr}>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <button type="button" class="btn btn-primary open-designer-btn" 
                                                            data-requirement-id="${requirement.id}">
                                                            <i class="bi bi-brush me-1"></i> {{ __('Open Designer') }}
                                                        </button>
                                                        <div class="design-preview" id="design_preview_${requirement.id}">
                                                            <span class="text-muted">{{ __('No design created yet') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            `;
                                            break;
                                    }

                                    requirementGroup.innerHTML = `
                                        <h6>${requirement.option_value_name}</h6>
                                        ${inputHtml}
                                    `;

                                    requirementsContainer.appendChild(requirementGroup);
                                });

                                // Attach event listeners to custom design buttons
                                document.querySelectorAll('.open-designer-btn').forEach(btn => {
                                    btn.addEventListener('click', function() {
                                        const requirementId = this.dataset.requirementId;
                                        openBusinessCardDesigner(requirementId);
                                    });
                                });
                            } else {
                                // Show no requirements message
                                noRequirementsMessage.classList.remove('d-none');
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching requirements:', error);
                            noRequirementsMessage.classList.remove('d-none');
                        });
                } else {
                    // Show no requirements message
                    noRequirementsMessage.classList.remove('d-none');
                }
            }

            // Function to update order summary
            function updateOrderSummary() {
                const summaryContainer = document.getElementById('selected-options-summary');
                summaryContainer.innerHTML = '';

                // Add product base info
                const productBaseItem = document.createElement('li');
                productBaseItem.className = 'list-group-item d-flex justify-content-between align-items-center';
                productBaseItem.innerHTML = `
                    <span>{{ __('Base Product') }}: {{ $product->{app()->getLocale() . '_name'} }}</span>
                    <span class="badge bg-primary rounded-pill">${basePrice.toLocaleString('en-US', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    })}</span>
                `;
                summaryContainer.appendChild(productBaseItem);

                // Add selected options
                optionGroups.forEach(group => {
                    const selectedRadio = group.querySelector('input[type="radio"]:checked');
                    if (selectedRadio) {
                        const optionName = selectedRadio.closest('li.list-group-item').querySelector(
                            'label.form-label').textContent.trim();
                        const valueName = selectedRadio.nextElementSibling.querySelector('.option-text')
                            .textContent.trim();
                        const additionalPrice = parseFloat(selectedRadio.dataset.price) || 0;

                        const optionItem = document.createElement('li');
                        optionItem.className =
                            'list-group-item d-flex justify-content-between align-items-center';
                        optionItem.innerHTML = `
                            <span>${optionName} <strong>${valueName}</strong></span>
                            ${additionalPrice > 0 ? `
                                        <span class="badge bg-success rounded-pill">+${additionalPrice.toLocaleString('en-US', {
                                            minimumFractionDigits: 2,
                                            maximumFractionDigits: 2
                                        })}</span>
                                    ` : ''}
                        `;
                        summaryContainer.appendChild(optionItem);
                    }
                });

                // Add total
                const totalItem = document.createElement('li');
                totalItem.className = 'list-group-item d-flex justify-content-between align-items-center fw-bold';
                totalItem.innerHTML = `
                    <span>{{ __('Total') }}</span>
                    <span>${calculateTotalPrice().toLocaleString('en-US', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    })}</span>
                `;
                summaryContainer.appendChild(totalItem);
            }

            // Initialize the requirements step
            updateRequirementsStep();

            // Form submission handler
            document.getElementById('product-order-form').addEventListener('submit', function(event) {
                // Prevent default form submission
                event.preventDefault();

                // Show loading indicator
                const submitButton = document.querySelector('button[type="submit"]');
                const originalButtonText = submitButton.innerHTML;
                submitButton.disabled = true;
                submitButton.innerHTML =
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ' +
                    "{{ __('Processing...') }}";

                // Create FormData object
                const formData = new FormData(this);

                // Add the total price to the form data
                formData.append('total_price', calculateTotalPrice());

                // Submit the form using fetch API
                fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        },
                        credentials: 'same-origin'
                    })
                    .then(response => { // Check if the response is ok
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => { // Check if the data is ok
                        if (data.success) {
                            // If payment is required, redirect to checkout page
                            if (data.redirect_to_payment) {
                                window.location.href = data.payment_url;
                            } else {
                                // Otherwise redirect to success page
                                window.location.href = data.success_url;
                            }
                        } else {
                            // Handle validation errors
                            if (data.errors) {
                                // Display errors to user
                                const errorContainer = document.getElementById('form-errors');
                                errorContainer.innerHTML = '';
                                errorContainer.classList.remove('d-none');

                                Object.keys(data.errors).forEach(key => {
                                    const errorMsg = document.createElement('div');
                                    errorMsg.className = 'alert alert-danger';
                                    errorMsg.textContent = data.errors[key];
                                    errorContainer.appendChild(errorMsg);
                                });

                                // Scroll to errors
                                errorContainer.scrollIntoView({
                                    behavior: 'smooth'
                                });
                            }

                            // Reset button
                            submitButton.disabled = false;
                            submitButton.innerHTML = originalButtonText;
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        // Show error message
                        const errorContainer = document.getElementById('form-errors');
                        errorContainer.innerHTML = '<div class="alert alert-danger">' +
                            "{{ __('An error occurred. Please try again.') }}" + '</div>';
                        errorContainer.classList.remove('d-none');

                        // Reset button
                        submitButton.disabled = false;
                        submitButton.innerHTML = originalButtonText;
                    });
            });

            // Helper function for translation
            function __(text) {
                // This is a simple implementation. In a real app, you might have a more sophisticated translation system
                return text;
            }
        });

        // Add this function after the updateRequirementsStep function
        function openBusinessCardDesigner(requirementId) {
            // Create modal if it doesn't exist
            if (!document.getElementById('businessCardDesignerModal')) {
                const modal = document.createElement('div');
                modal.className = 'modal fade';
                modal.id = 'businessCardDesignerModal';
                modal.tabIndex = '-1';
                modal.setAttribute('aria-labelledby', 'businessCardDesignerModalLabel');
                modal.setAttribute('aria-hidden', 'true');

                modal.innerHTML = `
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="businessCardDesignerModalLabel">{{ __('Business Card Designer') }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-8 d-flex justify-content-center align-items-center flex-column">
                                        <canvas id="cardCanvas" width="250" height="400" class="border shadow-sm mx-auto"></canvas>
                                        <div class="mt-3 text-center">
                                            <small class="text-muted">{{ __('Drag elements to position them') }}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="nav nav-tabs" id="designerTabs" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="background-tab" data-bs-toggle="tab" data-bs-target="#background" type="button" role="tab">{{ __('Background') }}</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="custom-tab" data-bs-toggle="tab" data-bs-target="#custom" type="button" role="tab">{{ __('Custom Elements') }}</button>
                                            </li>
                                        </ul>
                                        
                                        <div class="tab-content p-3 border border-top-0 rounded-bottom" id="designerTabsContent">
                                            <!-- Background Tab -->
                                            <div class="tab-pane fade show active" id="background" role="tabpanel" aria-labelledby="background-tab">
                                                <div class="mb-3">
                                                    <label class="form-label">{{ __('Background Color') }}</label>
                                                    <input type="color" class="form-control form-control-color" id="bgColorPicker" value="#ffffff">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">{{ __('Background Image') }}</label>
                                                    <input type="file" class="form-control" id="bgImageUpload" accept="image/*">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">{{ __('Background Opacity') }}</label>
                                                    <input type="range" class="form-range" id="bgOpacitySlider" min="10" max="100" value="100">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">{{ __('Text Color') }}</label>
                                                    <input type="color" class="form-control form-control-color" id="textColorPicker" value="#000000">
                                                </div>
                                            </div>
                                            
                                            <!-- Custom Elements Tab -->
                                            <div class="tab-pane fade" id="custom" role="tabpanel" aria-labelledby="custom-tab">
                                                <div class="mb-3">
                                                    <label class="form-label">{{ __('Logo') }}</label>
                                                    <input type="file" class="form-control" id="logoUpload" accept="image/*">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">{{ __('Add Custom Text') }}</label>
                                                    <input type="text" class="form-control mb-2" id="customElementText" placeholder="{{ __('Enter text') }}">
                                                    
                                                    <div class="row mb-2">
                                                        <div class="col-6">
                                                            <label class="form-label small">{{ __('Size') }}</label>
                                                            <select class="form-select" id="customElementSize">
                                                                <option value="14">{{ __('Small') }}</option>
                                                                <option value="18" selected>{{ __('Medium') }}</option>
                                                                <option value="24">{{ __('Large') }}</option>
                                                                <option value="32">{{ __('X-Large') }}</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-6">
                                                            <label class="form-label small">{{ __('Color') }}</label>
                                                            <input type="color" class="form-control form-control-color" id="customElementColor" value="#000000">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" type="checkbox" id="customElementBold">
                                                        <label class="form-check-label" for="customElementBold">
                                                            {{ __('Bold') }}
                                                        </label>
                                                    </div>
                                                    
                                                    <button type="button" class="btn btn-primary w-100" id="addCustomElementBtn">
                                                        <i class="bi bi-plus-circle me-1"></i> {{ __('Add Element') }}
                                                    </button>
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label class="form-label">{{ __('Custom Elements') }}</label>
                                                    <div id="customElementsList" class="border rounded p-2" style="max-height: 200px; overflow-y: auto;">
                                                        <p class="text-muted">{{ __('No custom elements added yet.') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                                <button type="button" class="btn btn-primary" id="saveDesignBtn">{{ __('Save Design') }}</button>
                            </div>
                        </div>
                    </div>
                `;

                document.body.appendChild(modal);

                // Load Fabric.js if not already loaded
                if (typeof fabric === 'undefined') {
                    const script = document.createElement('script');
                    script.src = 'https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.2.4/fabric.min.js';
                    script.onload = function() {
                        initBusinessCardDesigner(requirementId);
                    };
                    document.head.appendChild(script);
                } else {
                    initBusinessCardDesigner(requirementId);
                }
            } else {
                // If modal already exists, just initialize the designer with the new requirement ID
                initBusinessCardDesigner(requirementId);
            }

            // Show the modal
            const modalElement = document.getElementById('businessCardDesignerModal');
            const modal = new bootstrap.Modal(modalElement);
            modal.show();
        }

        // Initialize the business card designer
        function initBusinessCardDesigner(requirementId) {
            const BusinessCard = {
                canvas: null,
                requirementId: requirementId,
                config: {
                    bgColor: document.getElementById('bgColorPicker').value,
                    textColor: document.getElementById('textColorPicker').value,
                    imageUrl: '',
                    backgroundImageUrl: '',
                    customElements: [],
                    dpi: 300
                },

                init: function() {
                    // Create canvas
                    const displayWidth = 250;
                    const displayHeight = 400;

                    this.canvas = new fabric.Canvas('cardCanvas', {
                        backgroundColor: this.config.bgColor,
                        width: displayWidth,
                        height: displayHeight
                    });

                    // Set physical dimensions of the canvas element
                    const canvasEl = document.getElementById('cardCanvas');
                    canvasEl.width = displayWidth;
                    canvasEl.height = displayHeight;
                    canvasEl.style.width = displayWidth + 'px';
                    canvasEl.style.height = displayHeight + 'px';

                    // Add event listeners
                    document.getElementById('bgColorPicker').addEventListener('input', this.updateBackgroundColor
                        .bind(this));
                    document.getElementById('textColorPicker').addEventListener('input', this.updateTextColor.bind(
                        this));
                    document.getElementById('logoUpload').addEventListener('change', this.handleLogoUpload.bind(
                        this));
                    document.getElementById('bgImageUpload').addEventListener('change', this
                        .handleBackgroundImageUpload.bind(this));
                    document.getElementById('bgOpacitySlider').addEventListener('input', this
                        .updateBackgroundOpacity.bind(this));
                    document.getElementById('saveDesignBtn').addEventListener('click', this.saveDesign.bind(this));
                    document.getElementById('addCustomElementBtn').addEventListener('click', this.addCustomElement
                        .bind(this));

                    // Initial render
                    this.createCard();
                },

                createCard: function() {
                    this.canvas.clear();

                    // Set background color first
                    this.canvas.setBackgroundColor(this.config.bgColor, this.canvas.renderAll.bind(this.canvas));

                    // Add background image if exists
                    this.addBackgroundImage();

                    // Add logo if exists
                    this.addLogo();

                    // Add custom elements
                    this.addCustomElements();

                    this.canvas.renderAll();
                },

                updateBackgroundColor: function(e) {
                    this.config.bgColor = e.target.value;
                    this.canvas.setBackgroundColor(this.config.bgColor, this.canvas.renderAll.bind(this.canvas));
                },

                updateTextColor: function(e) {
                    this.config.textColor = e.target.value;
                    this.createCard(); // Recreate the card to update all text colors
                },

                updateBackgroundOpacity: function(e) {
                    const opacity = e.target.value / 100;
                    if (this.canvas.backgroundImage) {
                        this.canvas.backgroundImage.set({
                            opacity: opacity
                        });
                        this.canvas.renderAll();
                    }
                },

                handleLogoUpload: function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = (event) => {
                            this.config.imageUrl = event.target.result;
                            this.createCard();
                        };
                        reader.readAsDataURL(file);
                    }
                },

                handleBackgroundImageUpload: function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = (event) => {
                            this.config.backgroundImageUrl = event.target.result;
                            this.createCard();
                        };
                        reader.readAsDataURL(file);
                    }
                },

                addBackgroundImage: function() {
                    if (this.config.backgroundImageUrl) {
                        fabric.Image.fromURL(this.config.backgroundImageUrl, (img) => {
                            if (!img) return;

                            // Scale image to fit canvas
                            img.scaleToWidth(this.canvas.width);
                            if (img.getScaledHeight() < this.canvas.height) {
                                img.scaleToHeight(this.canvas.height);
                            }

                            // Center the image
                            img.set({
                                originX: 'center',
                                originY: 'center',
                                left: this.canvas.width / 2,
                                top: this.canvas.height / 2,
                                selectable: false,
                                evented: false,
                                opacity: document.getElementById('bgOpacitySlider').value / 100
                            });

                            this.canvas.setBackgroundImage(img, this.canvas.renderAll.bind(this.canvas));
                        });
                    }
                },

                addLogo: function() {
                    const imageUrl = this.config.imageUrl;
                    if (imageUrl) {
                        // Center the logo at the top for vertical layout
                        fabric.Image.fromURL(imageUrl, (img) => {
                            if (!img) return;

                            const centerX = this.canvas.width / 2;
                            const centerY = 50;

                            img.set({
                                originX: 'center',
                                originY: 'center',
                                left: centerX,
                                top: centerY,
                                selectable: true,
                                movable: true
                            });

                            // Scale the image to fit
                            const maxWidth = 100;
                            const maxHeight = 100;
                            if (img.width > maxWidth || img.height > maxHeight) {
                                const scaleX = maxWidth / img.width;
                                const scaleY = maxHeight / img.height;
                                const scale = Math.min(scaleX, scaleY);
                                img.scale(scale);
                            }

                            this.canvas.add(img);
                            this.canvas.renderAll();
                            this.logoAdded = true;
                        });
                    }
                },

                addCustomElements: function() {
                    this.currentYPosition = this.logoAdded ? 150 : 50;

                    if (Array.isArray(this.config.customElements)) {
                        this.config.customElements.forEach(element => {
                            const text = new fabric.Text(element.text, {
                                left: element.left || this.canvas.width / 2,
                                top: element.top || this.currentYPosition,
                                fontSize: element.fontSize || 18,
                                fontWeight: element.fontWeight || 'normal',
                                fill: element.color || this.config.textColor,
                                originX: 'center',
                                textAlign: 'center',
                                selectable: true,
                                movable: true
                            });
                            this.canvas.add(text);
                            this.currentYPosition += 30;
                        });
                    }
                },

                addCustomElement: function() {
                    const text = document.getElementById('customElementText').value;
                    const fontSize = parseInt(document.getElementById('customElementSize').value);
                    const fontWeight = document.getElementById('customElementBold').checked ? 'bold' : 'normal';
                    const color = document.getElementById('customElementColor').value;

                    if (text) {
                        if (!Array.isArray(this.config.customElements)) {
                            this.config.customElements = [];
                        }

                        this.config.customElements.push({
                            text: text,
                            fontSize: fontSize,
                            fontWeight: fontWeight,
                            color: color,
                            top: this.currentYPosition || 50
                        });

                        // Clear the input field
                        document.getElementById('customElementText').value = '';

                        // Update the card
                        this.createCard();

                        // Update the custom elements list
                        this.updateCustomElementsList();
                    }
                },

                updateCustomElementsList: function() {
                    const listContainer = document.getElementById('customElementsList');
                    if (listContainer) {
                        listContainer.innerHTML = '';

                        if (Array.isArray(this.config.customElements) && this.config.customElements.length > 0) {
                            this.config.customElements.forEach((element, index) => {
                                const item = document.createElement('div');
                                item.className =
                                    'custom-element-item d-flex justify-content-between align-items-center mb-2 p-2 border rounded';
                                item.innerHTML = `
                                    <span style="font-size: ${element.fontSize}px; font-weight: ${element.fontWeight}; color: ${element.color};">
                                        ${element.text}
                                    </span>
                                    <button type="button" class="btn btn-sm btn-danger remove-element" data-index="${index}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                `;
                                listContainer.appendChild(item);
                            });

                            // Add event listeners to remove buttons
                            document.querySelectorAll('.remove-element').forEach(btn => {
                                btn.addEventListener('click', (e) => {
                                    const index = parseInt(e.currentTarget.dataset.index);
                                    this.removeCustomElement(index);
                                });
                            });
                        } else {
                            listContainer.innerHTML =
                                '<p class="text-muted">{{ __('No custom elements added yet.') }}</p>';
                        }
                    }
                },

                removeCustomElement: function(index) {
                    if (Array.isArray(this.config.customElements) && index >= 0 && index < this.config
                        .customElements.length) {
                        this.config.customElements.splice(index, 1);
                        this.createCard();
                        this.updateCustomElementsList();
                    }
                },

                saveDesign: function() {
                    try {
                        // Set a higher DPI for export
                        const exportDpi = 300;
                        const scaleFactor = exportDpi / 96; // Standard screen DPI is 96

                        const dataURL = this.canvas.toDataURL({
                            format: 'png',
                            quality: 1,
                            multiplier: scaleFactor
                        });

                        // Save the design to the form
                        const inputField = document.getElementById(`req_${this.requirementId}`);
                        if (inputField) {
                            inputField.value = dataURL;

                            // Update preview
                            const previewElement = document.getElementById(`design_preview_${this.requirementId}`);
                            if (previewElement) {
                                previewElement.innerHTML = `
                                    <img src="${dataURL}" alt="Business Card Preview" style="max-height: 100px; max-width: 100%;" class="border shadow-sm">
                                `;
                            }

                            // Close the modal
                            const modalElement = document.getElementById('businessCardDesignerModal');
                            const modal = bootstrap.Modal.getInstance(modalElement);
                            modal.hide();

                            // Show success message
                            alert('{{ __('Design saved successfully!') }}');
                        }
                    } catch (error) {
                        console.error('Error saving design:', error);
                        alert('{{ __('Failed to save design. Please try again.') }}');
                    }
                }
            };

            BusinessCard.requirementId = requirementId;
            BusinessCard.init();
        }
    </script>
@endsection
