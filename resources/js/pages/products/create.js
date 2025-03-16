class ProductCreator {
    constructor() {
        this.optionsContainer = document.getElementById('optionsContainer');
        this.optionTemplate = document.getElementById('optionTemplate');
        this.optionIndex = 0;
        this.init();
    }

    init() {
        this.initAddOptionButton();
        this.initImagePreview();
    }

    initAddOptionButton() {
        document.getElementById('addOption').addEventListener('click', () => this.addNewOption());
    }

    initImagePreview() {
        const imageInput = document.getElementById('image');
        if (imageInput) {
            imageInput.addEventListener('change', (e) => this.handleImagePreview(e));
        }
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
        optionGroup.querySelector('.remove-option').addEventListener('click', (e) => {
            e.target.closest('.option-group').remove();
        });

        // Add value button
        optionGroup.querySelector('.add-value').addEventListener('click', (e) => {
            this.addNewValue(e.target.closest('.values-container'), this.optionIndex);
        });
    }

    addNewValue(valueContainer, optionIndex) {
        const valueInputs = valueContainer.querySelectorAll('.input-group').length;
        const newValueGroup = document.createElement('div');
        newValueGroup.className = 'input-group mb-2';
        newValueGroup.innerHTML = `
            <input type="text" class="form-control" name="options[${optionIndex}][values][${valueInputs}][ar_value]" placeholder="اسم القيمة (عربي)" required>
            <input type="text" class="form-control" name="options[${optionIndex}][values][${valueInputs}][en_value]" placeholder="Value name (English)" required>
            <input type="number" class="form-control" name="options[${optionIndex}][values][${valueInputs}][price]" placeholder="السعر الإضافي" step="0.01" required>
            <button type="button" class="btn btn-danger remove-value">
                <i class="bi bi-trash"></i>
            </button>
        `;

        newValueGroup.querySelector('.remove-value').addEventListener('click', (e) => {
            e.target.closest('.input-group').remove();
        });
        
        valueContainer.appendChild(newValueGroup);
    }

    handleImagePreview(event) {
        const input = event.target;
        const preview = document.getElementById('imagePreview');
        const previewImg = preview.querySelector('img');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = (e) => {
                previewImg.src = e.target.result;
                preview.classList.remove('d-none');
            }
            
            reader.readAsDataURL(input.files[0]);
        } else {
            previewImg.src = '';
            preview.classList.add('d-none');
        }
    }
}

// make it global
window.ProductCreator = ProductCreator;