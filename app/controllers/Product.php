<?php
use App\Logger;
use core\Helpers;
class Product extends Controller
{
    private $productModel;
    public $data = [];

    public function __construct()
    {
        try {
            $this->productModel = $this->model('ProductModel');

            if (!$this->productModel) {
                throw new Exception("Lỗi trong quá trình tạo đối tượng");
            }
        } catch (Exception $e) {
            header("Location:" . _BASE_URL . "/app/errors/loichung.php?message=" . urlencode($e->getMessage()));
            exit;
        }

    }

   
    
    public function TrangChu(){
        $outstanding_products = $this->productModel->get_BestSellingProducts();
        $flashSale_products = $this->productModel->get_ProductsFlashSale();
        $categories = $this->productModel->getCategories();

        if($outstanding_products){
            $this->data['outstanding_products'] = $outstanding_products;
        }else{
            $this->data['outstanding_products'] = [];
            Helpers::setFlash('empty_outstanding_products', 'Hiện tại không có sản phẩm nổi bật nào!');
        }

        if($flashSale_products){
            $this->data['flashSale_products'] = $flashSale_products;
        }else{
            $this->data['flashSale_products'] = [];
            Helpers::setFlash('empty_flashSale_products', 'Hiện tại không có sản phẩm flash sale!');
        }

        if($categories){
            $this->data['categories'] = $categories;
        }else{
            $this->data['categories'] = [];
            Helpers::setFlash('empty_categories', 'Không có thể loại sản phẩm nào!');
        }

        $this->render("products/TrangChu", $this->data);

    }

    public function stringProcessing($text) {
        $pattern = '/\s*\.\s*/';

        // Tách chuỗi
        $sentences = preg_split($pattern, $text);

        // Loại bỏ phần tử rỗng nếu có
        $sentences = array_filter($sentences, 'strlen');
        
        return $sentences;
    }

    public function productDetail($params){
        // Lấy id của product_type và id_product
        $value_params = $this->getValue_ofArrayParams($params);
        if(!$value_params){
           Logger::logError("Lỗi không lấy được id sản phẩm từ params!");
            Helpers::setFlash('error_params', 'Không tìm thấy sản phẩm này!');
            header("Location:" . _WEB_ROOT . "/trang-chu");
            exit;
        }
        $id_product = $value_params['secondLastValue'];
        $id_product_type = $value_params['lastValue'];

        // Lấy product tương ứng
        $product = $this->productModel->get_product($id_product);
       
        // lấy tất cả product_type của product đó và lấy 1 product_type mặc định và tất cả hình ảnh của product đó
        $images_product = $this->productModel->getAll_imageOfProduct($id_product);
        $product_types = $this->productModel->getAll_productType_ofProduct($id_product);
        $default_product_type = $this->productModel->getDefault_product_type ($id_product_type);


        if(!$product || !$product_types || !$default_product_type){
            Logger::logError("Lỗi không lấy được sản phẩm có id_product: ".$id_product." và id_productType: ". $id_product_type);
            Helpers::setFlash('error_params', 'Không tìm thấy sản phẩm này!');
            header("Location:" . _WEB_ROOT . "/trang-chu");
            exit;
        }
        if(!$images_product){
            Logger::logError("Lỗi không lấy được hình ảnh của sản phẩm có id_product: ".$id_product);
        }
        $name_product = trim(strtolower($product['product_name']));
        $name_product = explode(' ', $name_product)[0];

        $products_related = $this->productModel->get_relatedProducts($name_product);
        if(!$products_related){
            Logger::logError("Lỗi không lấy được sản phẩm liên quan đến sản phẩm có id_product: ".$id_product);
        }


        $this->data = [
            'images_product' => $images_product,
            'product' => $product,
            'product_types' => $product_types,
            'default_product_type' => $default_product_type,
            'products_related' => $products_related
        ];
       
        $description = $this->data['product']['description'];
        // Xử lý chuỗi sau đó đưa lại cho data
        $this->data['product']['description'] = $this->stringProcessing($description);
        
        $this->render("products/product_detail", $this->data);


    }

    // trả lời API (API response) để hiển thị dữ liệu tương ứng với product type mà người dùng chọn
    public function getProductType()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['product_type_id'])) {
            $id_product_type = intval($_GET['product_type_id']);
            
            $productType = $this->productModel->getDefault_product_type($id_product_type);

            if ($productType) {
                ob_clean();
                echo json_encode($productType);
            } else {
                ob_clean();
                echo json_encode(["error" => "Không tìm thấy sản phẩm"]);
            }
            exit; // Dừng script để tránh load cả trang web
        }
    }

    // Lấy các sản phẩm tùy vào lưaj chọn danh mục ở Văn phòng phẩm cho bạn ở trang chủ
    public function getProducts_ofCategory(){
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['category_id'])) {
           $category_id = $_GET['category_id'] ?? "";
           $category = $this->productModel->checkCategoryExists($category_id);
           if(!$category){
                ob_clean();
                echo json_encode(["error" => "Loại sản phẩm trên không tồn tại!"]);
                exit;
            }
            $products_ofCategory = $this->productModel->getProducts_ofCategory($category_id);
            if(!$products_ofCategory){
                ob_clean();
                echo json_encode(["error" => "không có product nào thuộc category trên!"]);
                exit;
            }
            ob_clean();
            echo json_encode($products_ofCategory);
            exit;
            
           
        }
        
    }
    
    public function detail()
    {
        $this->data["content"] = "products/detail";

        $this->render("layouts/client_layout", $this->data);
    }

    public function sanpham()
    {
        $this->render("products/ProductCategory");
    }
    

}
  

