<?php
use App\Logger;
require_once _DIR_ROOT . '/app/models/ProductModel.php';
require_once _DIR_ROOT . '/app/models/ProductTypeModel.php';
require_once _DIR_ROOT . '/app/models/ProductImageModel.php';

class ProductService {

   private $ProductModel;
   private $ProductTypeModel;
   private $ProductImageModel;

    public function __construct()
    {
        $this->ProductModel = new ProductModel();
        $this->ProductTypeModel = new ProductTypeModel();
        $this->ProductImageModel = new ProductImageModel();
    }
    
    public function createNewProduct($productData, $productTypes, $productImages) {

        
    

        $resultInsert_product = $this->ProductModel->addProduct($productData['name'], $productData['description'], $productData['category_id'],$productData['brand_id']);

        if (!$resultInsert_product) {
            return "Không thể tạo sản phẩm mới";
        }
        

        // Thêm các phân loại sản phẩm
        foreach ($productTypes as $type) {
            $resultInsert_productType = $this->ProductTypeModel->insertProductType($resultInsert_product, $type['name'], $type['image'], $type['priceCurrent'], $type['stock_quantity']);
            
            if (!$resultInsert_productType) {
                return "Không thể tạo loại sản phẩm mới". $type['name'];
                
            }
        }
        
        // Thêm ảnh sản phẩm
        if (!empty($productImages)) {
            foreach ($productImages as $image) {
               
                $result = $this->ProductImageModel->insertProductImage($resultInsert_product, $image['path']);
                if (!$result) {
                    return "Lỗi khi thêm ảnh sản phẩm";
                }
            }
        }

        return true;

       
    }

    public function tinhPhanTramGiam($giaGoc, $giaGiam) {
        if ($giaGoc <= 0) {
            return 0; 
        }
        $phanTramGiam = (($giaGoc - $giaGiam) / $giaGoc) * 100;
        return round($phanTramGiam); 
    }

    public function editingProduct($productData, $productTypes, $productImages, $product_id) {
       

        // Cập nhật thông tin sản phẩm cơ bản
        $resultUpdate_product = $this->ProductModel->updateProductID(
            $productData['name'],
            $productData['description'], 
            $productData['category_id'], 
            $productData['brand_id'],
            $product_id
        );
        
        
        if ($resultUpdate_product !== true) {
            Logger::logError("Lỗi cập nhật sản phẩm: " . $resultUpdate_product);
            return "Lỗi cập nhật thông tin sản phẩm";
        }
        
        // Cập nhật các phân loại sản phẩm
        foreach ($productTypes as $type) {
            // Tính toán giảm giá nếu có giá mới
            $discount = 0;
            if (!empty($type['priceNew']) && $type['priceNew'] < $type['priceCurrent']) {
                $discount = $this->tinhPhanTramGiam($type['priceCurrent'], $type['priceNew']);
            }

            // Kiểm tra xem là cập nhật hay thêm mới
            if (!empty($type['product_type_id'])) {
                
                // Cập nhật product type hiện có
                $resultUpdate_productType = $this->ProductTypeModel->updateProductTypeID(
                    $type['name'],
                    $type['image'] ?? null, 
                    $type['priceNew'],
                    $type['priceCurrent'],
                    $type['stock_quantity'],
                    $discount,
                    $type['product_type_id']
                    
                );
                
                if ($resultUpdate_productType !== true) {
                    Logger::logError("Lỗi cập nhật product type: " . $resultUpdate_productType);
                    return "Lỗi cập nhật phân loại sản phẩm";
                }
            } else {
                // Thêm product type mới
                $resultInsert_productType = $this->ProductTypeModel->insertProductType(
                    $product_id,
                    $type['name'],
                    $type['image'] ?? null,
                    $type['priceCurrent'],
                    $type['stock_quantity']
                );
                
                if (!$resultInsert_productType) {
                    Logger::logError("Lỗi thêm product type mới");
                    return "Lỗi thêm phân loại sản phẩm mới";
                }
            }
        }
        
        // // Xử lý ảnh sản phẩm
        if (!empty($productImages)) {
            // Xóa ảnh cũ
            $deleteImage = $this->ProductImageModel->deleteProductImageID($product_id);
            if ($deleteImage !== true) {
                Logger::logError("Lỗi xóa ảnh cũ: " . $deleteImage);
                return "Lỗi cập nhật ảnh sản phẩm";
            }
            
            // Thêm ảnh mới
            foreach ($productImages as $image) {
                $result = $this->ProductImageModel->insertProductImage($product_id, $image['path']);
                if (!$result) {
                    Logger::logError("Lỗi thêm ảnh mới");
                    return "Lỗi thêm ảnh sản phẩm";
                }
            }
        }
       

        return true;
        
    }

    
}