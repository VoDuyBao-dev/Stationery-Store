function createProductTypeHTMLsua(index) {
    return `
        <div class="product-type-section">
            <!-- New product type won't have product_type_id -->
            <input type="hidden" name="product_types[${index}][product_type_id]" value="" />
            <input type="hidden" name="product_types[${index}][is_new]" value="1" />
            
            <div class="form-row">
                <div class="form-group">
                    <label>Tên phân loại</label>
                    <input type="text" name="product_types[${index}][productType_name]" required />
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
            <!-- ...existing fields... -->
            <button type="button" class="btn-xoa-phan-loai" onclick="this.closest('.product-type-section').remove()">
                Xóa phân loại
            </button>
        </div>
    `;
}