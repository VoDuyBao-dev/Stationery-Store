<?php

use App\Logger;
use core\Helpers;

class Cart extends Controller
{
    private $productModel;
    private $transportModel;

    public function __construct()
    {
        $this->productModel = $this->model('ProductModel');
        $this->transportModel = $this->model('TransportModel');
    }

    public function handle_cart()
    {
        if (isset($_POST['addcart']) || isset($_POST['buynow'])) {
            $product_type_id = $_POST['product_type_id'];
            // Kiểm tra tồn kho
            $stock = $this->productModel->getStockQuantity($product_type_id);
            if (!$stock || $stock['stock_quantity'] <= 0) {
                Helpers::setFlash('notification', [
                    'type' => 'error',
                    'message' => 'Sản phẩm đã hết hàng!'
                ]);
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }
        }
        if (isset($_POST['addcart'])) {
            $this->add_cart();
            exit();
        } else if (isset($_POST['buynow'])) {
            $this->buyNow();
            exit();
        }
    }
    private function addToCartFromPost()
    {
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
            $_SESSION['giohang'][$product_type_id]['quantity'] += $soluong;
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
        Helpers::setFlash('notification', ['type' => 'success', 'message' => 'Thêm sản phẩm vào giỏ hàng thành công!']);
        header("Location:" . _WEB_ROOT . "/thong-tin-sp/" . $encoded_product_name . "/" . $_POST['product_id'] . "/" . $_POST['product_type_id']);
        exit;
    }

    public function buyNow()
    {

        // Xử lý thêm sản phẩm vô giỏ hàng và trả về tên sp để redirect
        $product_name = $this->addToCartFromPost();
        header("Location:" . _WEB_ROOT . "/thanh-toan");
        exit;
    }

    public function view_cart()
    {
        $this->checkLogin();
        $this->render("products/giohang");
    }

    public function deleteAll_cart()
    {
        $this->checkLogin();
        if (isset($_POST['deleteAll_cart'])) {
            $_SESSION['giohang'] = [];
            header("Location:" . _WEB_ROOT . "/view_cart");
            exit;
        }
    }

    public function deleteIdProduct_inCart($params)
    {
        $this->checkLogin();
        $value_params = $this->getValue_ofArrayParams($params);
        $id_product_type = $value_params['lastValue'];
        unset($_SESSION['giohang'][$id_product_type]);
        if (count($_SESSION['giohang']) > 0) {
            header("Location:" . _WEB_ROOT . "/view_cart");
        } else {
            header("Location:" . _WEB_ROOT . "/trang-chu");
        }
    }

    // Kiểm tra số lượng hàng tồn kho trước khi thanh toán
    // Lấy thông tin vận chuyển  qua trang thanh toán 
    public function getTransport_Payment()
    {

        $stockQuantityOf_allProducts = $this->productModel->stockQuantityOf_allProducts();
        $messages = [];

        foreach ($_SESSION['giohang'] as $product_type_id => $product) {

            $Quantity = (int)$product['quantity'];
            $stockQuantity = 0;

            foreach ($stockQuantityOf_allProducts as $ProductInStock) {
                if ($ProductInStock['product_type_id'] == $product_type_id) {
                    $stockQuantity = (int)$ProductInStock['stock_quantity'];
                    break;
                }
            }


            if ($Quantity > $stockQuantity) {
                // Cập nhật lại số lượng trong giỏ hàng
                $_SESSION['giohang'][$product_type_id]['quantity'] = $stockQuantity;

                // Tạo thông báo
                $messages[] = "- <strong>{$product['name_product_type_id']}</strong>: giảm từ {$Quantity} xuống còn {$stockQuantity}";
            }
        }

        // Hiển thị thông báo nếu có sản phẩm bị thay đổi
        if (!empty($messages)) {
            $messageHtml = "Một số sản phẩm đã được cập nhật số lượng do vượt quá tồn kho:<br>" . implode("<br>", $messages);

            Helpers::setFlash('notification', [
                'type' => 'warning',
                'message' => $messageHtml
            ]);

            header("Location:" . _WEB_ROOT . "/view_cart");
            exit;
        }

        $listTransport = $this->transportModel->getAllTransport();
        $data = [
            'listTransport' => $listTransport,
        ];
        $this->render("users/payment/Payment", $data);
    }
}
