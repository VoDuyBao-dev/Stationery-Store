// Handle main product images preview
function handleProductImages() {
    const fileInput = document.getElementById('product-images');
    const previewContainer = document.getElementById('preview-container');

    fileInput.addEventListener('change', function() {
        previewContainer.innerHTML = ''; // Clear existing previews
        
        Array.from(this.files).forEach(file => {
            if (!file.type.startsWith('image/')) return;

            const previewDiv = document.createElement('div');
            previewDiv.className = 'preview-item';

            const img = document.createElement('img');
            const reader = new FileReader();

            reader.onload = function(e) {
                img.src = e.target.result;
            };

            const removeButton = document.createElement('button');
            removeButton.innerHTML = '×';
            removeButton.className = 'remove-preview';
            removeButton.onclick = function() {
                previewDiv.remove();
            };

            previewDiv.appendChild(img);
            previewDiv.appendChild(removeButton);
            previewContainer.appendChild(previewDiv);

            reader.readAsDataURL(file);
        });
    });
}

// Handle product type image preview
window.previewMainImage = function(input) {
    const preview = input.parentElement.querySelector('.preview-main-image');
    preview.innerHTML = '';
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        const previewDiv = document.createElement('div');
        previewDiv.className = 'preview-item';

        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            
            const removeButton = document.createElement('button');
            removeButton.innerHTML = '×';
            removeButton.className = 'remove-preview';
            removeButton.onclick = function() {
                preview.innerHTML = '';
                input.value = '';
            };

            previewDiv.appendChild(img);
            previewDiv.appendChild(removeButton);
            preview.appendChild(previewDiv);
        };
        
        reader.readAsDataURL(input.files[0]);
    }
};

document.addEventListener('DOMContentLoaded', function() {
    // Initialize product images preview
    handleProductImages();

    let typeCount = 1;
    const productTypesContainer = document.getElementById('product-types');
    const addTypeButton = document.getElementById('add-type');

    // Xử lý nút thêm phân loại
    addTypeButton.addEventListener('click', function() {
        const newSection = document.createElement('div');
        newSection.className = 'product-type-section';
        newSection.innerHTML = createProductTypeHTML(typeCount);
        productTypesContainer.appendChild(newSection);
        typeCount++;
    });
});

// Thêm hàm validate ở đầu file
function validateNumber(input, fieldName) {
    if (input.value < 0) {
        input.value = 0;
        alert(`${fieldName} không được âm`);
        return false;
    }
    return true;
}

// Cập nhật phần tạo HTML cho phân loại mới
function createProductTypeHTML(index) {
    return `
        <div class="form-row">
            <div class="form-group">
                <label>Tên phân loại</label>
                <input type="text" name="product_types[${index}][name]" required />
            </div>
            <div class="form-group">
                <label>Giá bán</label>
                <input type="number" 
                       name="product_types[${index}][priceCurrent]" 
                       min="0" 
                       
                       oninput="validateNumber(this, 'Giá bán')"
                       required />
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Số lượng</label>
                <input type="number" 
                       name="product_types[${index}][stock_quantity]" 
                       min="0" 
                       step="1"
                       oninput="validateNumber(this, 'Số lượng')"
                       required />
            </div>
            <div class="form-group">
                <label>Ảnh chính phân loại</label>
                <input type="file" name="product_types[${index}][main_image]" accept="image/*" required class="main-image-input" onchange="previewMainImage(this)" />
                <div class="preview-main-image"></div>
            </div>
            ${index > 0 ? `
            <div class="form-group">
                <button type="button" class="btn-xoa-phan-loai" onclick="this.closest('.product-type-section').remove()">
                    Xóa phân loại
                </button>
            </div>
            ` : ''}
        </div>
    `;
}