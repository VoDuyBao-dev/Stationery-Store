document.addEventListener("DOMContentLoaded", function () {
    const tabs = document.querySelectorAll(".tabs-title");
    const productContainer = document.querySelector(".tab-1 .product-list");
    const viewMoreBtn = document.querySelector('.view-more-btn');

    function loadProducts(categoryId) {
        fetch(`${_WEB_ROOT}/getProductsBy_category?category_id=${categoryId}`)
            .then(response => response.text())
            .then(text => {
                return JSON.parse(text);
            })
            .then(data => {
                console.log("Dữ liệu nhận được:", data);

                productContainer.innerHTML = ""; // Xóa nội dung cũ

                if (!Array.isArray(data)) {
                    productContainer.innerHTML = `<p>Lỗi: Dữ liệu không hợp lệ!</p>`;
                    return;
                }

                if (data.length === 0) {
                    productContainer.innerHTML = `<p class="no-products">Không có sản phẩm nào.</p>`;
                    return;
                }

                data.forEach(product => {
                    let productDiv = document.createElement("div");
                    productDiv.classList.add("product");


                    let productLink = document.createElement("a");
                    productLink.href = `${_WEB_ROOT}/thong-tin-sp/${product.product_name}/${product.product_id}/${product.product_type_id}`;

                   // Tạo product-block-item
                   let productBlockItem = document.createElement("div");
                   productBlockItem.classList.add("product-block-item");
                   productBlockItem.style.position = "relative"; // Thêm position relative

                    
                    let productImage = document.createElement("img");
                    productImage.src = `${_WEB_ROOT}/public/assets/clients/images/image_products_type/${product.image || 'default.jpg'}`;
                    productImage.alt = product.product_name;
                    productImage.width = 150;
                    productImage.height = 250;
                    productLink.appendChild(productImage);
                    

                     
                     // Thêm sale tag
                     if (product.priceOld && product.priceCurrent) {
                        const discount = Math.round(((product.priceOld - product.priceCurrent) / product.priceOld) * 100);
                        if (discount > 0) {
                            let saleTagDiv = document.createElement("div");
                            saleTagDiv.classList.add("sale-tag");
                            saleTagDiv.innerHTML = `<p>Sale <br> ${discount}%</p>`;
                            productBlockItem.appendChild(saleTagDiv);
                        }
                    }
    
                    productBlockItem.appendChild(productImage);
                    productLink.appendChild(productBlockItem);

                    let productInfo = document.createElement("div");
                    productInfo.classList.add("product-info");

                    let productName = document.createElement("a");
                    productName.href = `${_WEB_ROOT}/thong-tin-sp/${product.product_name}/${product.product_id}/${product.product_type_id}`;
                    productName.innerText = product.product_name;

                    let priceContainer = document.createElement("div");
                    priceContainer.classList.add("product-price");

                    let price = document.createElement("span");
                    price.classList.add("price");
                    price.innerText = product.priceCurrent ? formatCurrencyVND(product.priceCurrent) : "Liên hệ";

                    priceContainer.appendChild(price);

                    if (product.priceOld) {
                        let oldPrice = document.createElement("span");
                        oldPrice.classList.add("old-price");
                        oldPrice.innerText = formatCurrencyVND(product.priceOld);
                        priceContainer.appendChild(oldPrice);
                    }
                    

                    productInfo.appendChild(productName);
                    productInfo.appendChild(priceContainer);
                    

                    productDiv.appendChild(productLink);
                    productDiv.appendChild(productInfo);

                    productContainer.appendChild(productDiv);
                });

                document.querySelector(".tab-1").classList.add("current");
            })
            .catch(error => {
                console.error("Lỗi:", error);
                productContainer.innerHTML = `<p>Lỗi tải dữ liệu!</p>`;
            });
    }

    tabs.forEach(tab => {
        tab.addEventListener("click", function () {
            tabs.forEach(t => t.classList.remove("active"));
            document.querySelectorAll(".tab-content").forEach(c => c.classList.remove("current"));

            this.classList.add("active");

            let categoryId = this.getAttribute("data-id");
            loadProducts(categoryId);

            // Cập nhật href cho nút xem thêm
            const categoryName = this.querySelector('span').textContent;
            const categoryLink = `${_WEB_ROOT}/productByCategory?category=${encodeURIComponent(categoryName)}&sub=${encodeURIComponent(categoryName)}`;
            viewMoreBtn.setAttribute('data-href', categoryLink);
        });
    });

    // Xử lý click nút xem thêm
    viewMoreBtn.addEventListener('click', function() {
        const link = this.getAttribute('data-href');
        if (link) {
            window.location.href = link;
        }
    });

    // Kích hoạt tab đầu tiên khi tải trang
    if (tabs.length > 0) {
        tabs[0].click();

        // Thiết lập link mặc định cho tab đầu tiên
        const firstTabName = tabs[0].querySelector('span').textContent;
        const defaultLink = `${_WEB_ROOT}/productByCategory?category=${encodeURIComponent(firstTabName)}&sub=${encodeURIComponent(firstTabName)}`;
        viewMoreBtn.setAttribute('data-href', defaultLink);
    }
});

