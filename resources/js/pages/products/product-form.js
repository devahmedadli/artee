class ProductForm {
    constructor() {
        this.optionsContainer = document.getElementById('optionsContainer');
        this.optionTemplate = document.getElementById('optionTemplate');
        this.requirementTemplate = document.getElementById('requirementTemplate');
        // Get the count of existing options for edit mode, or start from 0 for create mode
        this.optionIndex = document.querySelectorAll('.option-group').length;
        this.init();
    }

    init() {
        this.initAddOptionButton();
        this.initImageHandlers();
        this.initExistingOptions();
    }

    initAddOptionButton() {
        const addButton = document.getElementById('addOption');
        if (addButton) {
            addButton.addEventListener('click', () => this.addNewOption());
        }
    }

    initImageHandlers() {
        // Image placeholder click handler
        const imagePlaceholder = document.getElementById('imagePlaceholder');
        if (imagePlaceholder) {
            imagePlaceholder.addEventListener('click', () => {
                document.getElementById('image').click();
            });
        }

        // Image input change handler
        const imageInput = document.getElementById('image');
        if (imageInput) {
            imageInput.addEventListener('change', (e) => this.previewImage(e.target));
        }
    }

    previewImage(input) {
        const file = input.files[0];
        const placeholder = document.getElementById('imagePlaceholder');
        const canvas = document.getElementById('canvas');
        const ctx = canvas.getContext('2d');

        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                const img = new Image();
                img.onload = () => {
                    const size = Math.min(img.width, img.height);
                    canvas.width = size;
                    canvas.height = size;
                    
                    ctx.drawImage(
                        img, 
                        (img.width - size) / 2, 
                        (img.height - size) / 2, 
                        size, 
                        size, 
                        0, 
                        0, 
                        size, 
                        size
                    );
                    
                    const croppedImageUrl = canvas.toDataURL();
                    placeholder.style.backgroundImage = `url(${croppedImageUrl})`;
                    placeholder.innerHTML = '';
                };
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
        } else {
            placeholder.style.backgroundImage = '';
            placeholder.innerHTML = '<i class="bi bi-image" style="font-size: 50px;"></i>';
        }
    }

    initExistingOptions() {
        // Add event listeners to existing option groups (for both create and edit)
        document.querySelectorAll('.option-group').forEach(optionGroup => {
            this.attachOptionEventListeners(optionGroup);
            
            // Add event listeners to existing remove value buttons
            optionGroup.querySelectorAll('.remove-value').forEach(button => {
                button.addEventListener('click', (e) => {
                    const valueGroup = e.target.closest('.input-group');
                    const requirementsContainer = valueGroup.nextElementSibling;
                    if (requirementsContainer && requirementsContainer.classList.contains('requirements-container')) {
                        requirementsContainer.remove();
                    }
                    valueGroup.remove();
                });
            });
            
            // Add event listeners to existing remove requirement buttons
            optionGroup.querySelectorAll('.remove-requirement').forEach(button => {
                button.addEventListener('click', (e) => {
                    e.target.closest('.requirement-item').remove();
                });
            });
        });
    }

    addNewOption() {
        const optionContent = this.optionTemplate.content.cloneNode(true);
        const optionGroup = optionContent.querySelector('.option-group');
        
        this.updateOptionIndexes(optionGroup);
        this.attachOptionEventListeners(optionGroup);
        
        this.optionsContainer.appendChild(optionGroup);
        this.optionIndex++;
    }

    updateOptionIndexes(optionGroup) {
        optionGroup.querySelectorAll('[name*="__INDEX__"]').forEach(input => {
            input.name = input.name.replace('__INDEX__', this.optionIndex);
        });
    }

    attachOptionEventListeners(optionGroup) {
        // Remove option button
        const removeOptionBtn = optionGroup.querySelector('.remove-option');
        if (removeOptionBtn) {
            removeOptionBtn.addEventListener('click', (e) => {
                e.target.closest('.option-group').remove();
            });
        }

        // Add value button
        const addValueBtn = optionGroup.querySelector('.add-value');
        if (addValueBtn) {
            addValueBtn.addEventListener('click', (e) => {
                const valuesContainer = e.target.closest('.option-group').querySelector('.values-container');
                this.addNewValue(valuesContainer, this.getOptionIndex(e.target));
            });
        }
        
        // Add requirement toggle buttons for existing values
        optionGroup.querySelectorAll('.add-requirement').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const valueGroup = e.target.closest('.input-group');
                const requirementsContainer = valueGroup.nextElementSibling;
                requirementsContainer.classList.toggle('d-none');
            });
        });
        
        // Add new requirement buttons for existing values
        optionGroup.querySelectorAll('.add-new-requirement').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const requirementsContainer = e.target.closest('.requirements-container');
                const requirementsList = requirementsContainer.querySelector('.requirements-list');
                const valueGroup = requirementsContainer.previousElementSibling;
                
                const optionIndex = this.getOptionIndex(e.target);
                const valueIndex = this.getValueIndex(valueGroup);
                
                this.addNewRequirement(requirementsList, optionIndex, valueIndex);
            });
        });
    }

    getOptionIndex(element) {
        const optionGroup = element.closest('.option-group');
        const allGroups = Array.from(document.querySelectorAll('.option-group'));
        return allGroups.indexOf(optionGroup);
    }
    
    getValueIndex(valueGroup) {
        const valuesContainer = valueGroup.closest('.values-container');
        const allValueGroups = Array.from(valuesContainer.querySelectorAll('.input-group'));
        return allValueGroups.indexOf(valueGroup);
    }

    addNewValue(valueContainer, optionIndex) {
        const valueInputs = valueContainer.querySelectorAll('.input-group').length;
        const newValueGroup = document.createElement('div');
        newValueGroup.className = 'input-group mb-2';
        newValueGroup.innerHTML = `
            <input type="text" class="form-control" name="options[${optionIndex}][values][${valueInputs}][ar_value]" 
                placeholder="اسم القيمة (عربي)" required>
            <input type="text" class="form-control" name="options[${optionIndex}][values][${valueInputs}][en_value]" 
                placeholder="Value name (English)" required>
            <input type="number" class="form-control" name="options[${optionIndex}][values][${valueInputs}][price]" 
                placeholder="السعر الإضافي" step="0.01" required>
            <button type="button" class="btn btn-danger remove-value">
                <i class="bi bi-trash"></i>
            </button>
            <button type="button" class="btn btn-info add-requirement" title="Add Requirements">
                <i class="bi bi-list-check"></i>
            </button>
        `;

        // Add requirements container
        const requirementsContainer = document.createElement('div');
        requirementsContainer.className = 'requirements-container d-none mb-3';
        requirementsContainer.innerHTML = `
            <div class="requirements-list p-2 border-start border-end border-bottom rounded-bottom">
                <!-- Requirements will be added here -->
            </div>
            <div class="d-flex justify-content-end mt-2">
                <button type="button" class="btn btn-sm btn-primary add-new-requirement">
                    <i class="bi bi-plus-circle me-1"></i> Add Requirement
                </button>
            </div>
        `;

        newValueGroup.querySelector('.remove-value').addEventListener('click', (e) => {
            const valueGroup = e.target.closest('.input-group');
            const requirementsContainer = valueGroup.nextElementSibling;
            if (requirementsContainer && requirementsContainer.classList.contains('requirements-container')) {
                requirementsContainer.remove();
            }
            valueGroup.remove();
        });
        
        // Add requirement toggle button event
        newValueGroup.querySelector('.add-requirement').addEventListener('click', (e) => {
            requirementsContainer.classList.toggle('d-none');
        });
        
        // Add new requirement button event
        requirementsContainer.querySelector('.add-new-requirement').addEventListener('click', (e) => {
            const requirementsList = requirementsContainer.querySelector('.requirements-list');
            this.addNewRequirement(requirementsList, optionIndex, valueInputs);
        });
        
        valueContainer.appendChild(newValueGroup);
        valueContainer.appendChild(requirementsContainer);
    }
    
    addNewRequirement(requirementsList, optionIndex, valueIndex) {
        const requirementCount = requirementsList.querySelectorAll('.requirement-item').length;
        const requirementContent = this.requirementTemplate.content.cloneNode(true);
        const requirementItem = requirementContent.querySelector('.requirement-item');
        
        // Update indexes
        requirementItem.querySelectorAll('[name*="__OPTION_INDEX__"]').forEach(input => {
            input.name = input.name.replace('__OPTION_INDEX__', optionIndex);
        });
        
        requirementItem.querySelectorAll('[name*="__VALUE_INDEX__"]').forEach(input => {
            input.name = input.name.replace('__VALUE_INDEX__', valueIndex);
        });
        
        requirementItem.querySelectorAll('[name*="__REQ_INDEX__"]').forEach(input => {
            input.name = input.name.replace('__REQ_INDEX__', requirementCount);
        });
        
        requirementItem.querySelectorAll('[id*="__OPTION_INDEX__"]').forEach(input => {
            input.id = input.id.replace('__OPTION_INDEX__', optionIndex);
        });
        
        requirementItem.querySelectorAll('[id*="__VALUE_INDEX__"]').forEach(input => {
            input.id = input.id.replace('__VALUE_INDEX__', valueIndex);
        });
        
        requirementItem.querySelectorAll('[id*="__REQ_INDEX__"]').forEach(input => {
            input.id = input.id.replace('__REQ_INDEX__', requirementCount);
        });
        
        requirementItem.querySelectorAll('[for*="__OPTION_INDEX__"]').forEach(label => {
            label.setAttribute('for', label.getAttribute('for').replace('__OPTION_INDEX__', optionIndex));
        });
        
        requirementItem.querySelectorAll('[for*="__VALUE_INDEX__"]').forEach(label => {
            label.setAttribute('for', label.getAttribute('for').replace('__VALUE_INDEX__', valueIndex));
        });
        
        requirementItem.querySelectorAll('[for*="__REQ_INDEX__"]').forEach(label => {
            label.setAttribute('for', label.getAttribute('for').replace('__REQ_INDEX__', requirementCount));
        });
        
        // Add remove requirement button event
        requirementItem.querySelector('.remove-requirement').addEventListener('click', (e) => {
            e.target.closest('.requirement-item').remove();
        });
        
        requirementsList.appendChild(requirementItem);
    }
}

// Initialize the form
document.addEventListener('DOMContentLoaded', function() {
    new ProductForm();
});

// Make it global
window.ProductForm = ProductForm; 