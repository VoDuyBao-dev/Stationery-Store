<?php
use App\Logger;
require_once _DIR_ROOT . '/app/models/ProductModel.php';
require_once _DIR_ROOT . '/app/models/ProductTypeModel.php';
require_once _DIR_ROOT . '/app/models/ProductImageModel.php';

class ProductService {
    
    public function createNewProduct($productData, $productTypes, $productImages) {

        $ProductModel = new ProductModel();
        $ProductTypeModel = new ProductTypeModel();
        $ProductImageModel = new ProductImageModel();
    

        $resultInsert_product = $ProductModel->addProduct($productData['name'], $productData['description'], $productData['category_id'],$productData['brand_id']);

        if (!$resultInsert_product) {
            return "Không thể tạo sản phẩm mới";
        }
        

        // Thêm các phân loại sản phẩm
        foreach ($productTypes as $type) {
            $resultInsert_productType = $ProductTypeModel->insertProductType($resultInsert_product, $type['name'], $type['image'], $type['priceCurrent'], $type['stock_quantity']);
            
            if (!$resultInsert_productType) {
                return "Không thể tạo loại sản phẩm mới". $type['name'];
                
            }
        }
        
        // Thêm ảnh sản phẩm
        if (!empty($productImages)) {
            foreach ($productImages as $image) {
               
                $result = $ProductImageModel->insertProductImage($resultInsert_product, $image['path']);
                if (!$result) {
                    return "Lỗi khi thêm ảnh sản phẩm";
                }
            }
        }

        return true;

       
    }
}