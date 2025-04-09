<?php
use App\Logger;
use core\Helpers;

class Cart extends Controller
{

    public function handle_cart()
    {
        if (isset($_POST['addcart'])) {
           $this->add_cart();
           exit();
        }else if (isset($_POST['buynow'])) {
            $this->buyNow();
            exit();
        }
           
    }
    private function addToCartFromPost(){
        $name_product_type_id = $_POST['product_name_type_id'];
        $product_id = $_POST['product_id'];
        $product_type_id = $_POST['product_type_id'];
        $product_name = $_POST['product_name'];
        $image = $_POST['image'];
        $priceCurrent = $_POST['priceCurrent'];
        $priceOld = $_POST['priceOld'];
        $soluong = $_POST['quantity'];
    
        // Kiểm tra nếu sản phẩm đã có trong giỏ hàng, tăng số lượng
        if (isset($_SESSION['giohang'][$product_type_id])) {
            $_SESSION['giohang'][$product_type_id]['quantity'] += 1;
        } else {
            $sp = [
                'name_product_type_id' => $name_product_type_id,
                'product_id' => $product_id,
                'product_type_id' => $product_type_id,
                'product_name' => $product_name,
                'image' => $image,
                'priceCurrent' => $priceCurrent,
                'priceOld' => $priceOld,
                'quantity' => $soluong,
            ];
            
            $_SESSION['giohang'][$product_type_id] = $sp;
        }

        return $product_name;
    }



    public function add_cart()
    {
       
        // Xử lý thêm sản phẩm vô giỏ hàng và trả về tên sp để redirect
        $product_name = $this->addToCartFromPost();
        // Mã hóa tên sản phẩm
        $encoded_product_name = urlencode($product_name);
        
        Helpers::setFlash('add_cart', 'Thêm sản phẩm vào giỏ hàng thành công!');
        header("Location:" . _WEB_ROOT . "/thong-tin-sp/" . $encoded_product_name . "/" . $_POST['product_id'] . "/" . $_POST['product_type_id']);
        exit;
        
    }

    public function buyNow(){
        
        // Xử lý thêm sản phẩm vô giỏ hàng và trả về tên sp để redirect
        $product_name = $this->addToCartFromPost();
        header("Location:" . _WEB_ROOT . "/thanh-toan");
        exit;
        
    }
    
    public function view_cart(){
        $this->render("products/giohang_tamthoi");
    }

    public function deleteAll_cart(){
        if(isset($_POST['deleteAll_cart'])){
            $_SESSION['giohang'] = [];
            header("Location:" . _WEB_ROOT . "/view_cart");
            exit;
        }
    }
    
    public function deleteIdProduct_inCart($params){
        $value_params = $this->getValue_ofArrayParams($params);
        $id_product_type = $value_params['lastValue'];
        unset($_SESSION['giohang'][$id_product_type]);
        if(count($_SESSION['giohang']) > 0){
            header("Location:" . _WEB_ROOT . "/view_cart");
        }else{
            header("Location:" . _WEB_ROOT . "/trang-chu");
        }
    }
}
?>