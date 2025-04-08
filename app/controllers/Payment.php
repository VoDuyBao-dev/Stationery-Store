<?php

//Kế thừa lại Controller bên core để dùng method của nó
class Payment extends Controller
{
   
    

    public function initPayment()
    {

        
       if(!isset($_POST['payment'])){
            ob_clean();
            echo json_encode(['success' => false, 'message' => 'Không có phương thức thanh toán']);
            return;
        }

        $paymentMethod = $_POST['payment'];
       

        if( $paymentMethod === "cod"){
            // thanh toán khi nhận hàng thì không xử lý gì thêm
            $this->finalizePayment($paymentMethod);
        }
        else if($paymentMethod === "ewallet"){
            // xử lí momo
            $success = true;

            if ($success) {
                ob_clean();
                $this->finalizePayment($paymentMethod);
            } else {
                ob_clean();
                echo json_encode(['success' => false, 'message' => 'Thanh toán Momo thất bại']);
            }
        }
        else if($paymentMethod === "bank"){
                // xu lí VNPay
                $success = true;

                if ($success) {
                    $this->finalizePayment($paymentMethod);
                } else {
                    ob_clean();
                    echo json_encode(['success' => false, 'message' => 'Thanh toán ngân hàng thất bại']);
                }
        }
    else{
            ob_clean();
            echo json_encode(['success' => false, 'message' => 'Phương thức không hợp lệ']);
        }
        
        
}

    private function finalizePayment($paymentMethod)
    {
        // Gọi service để xử lý đơn hàng và thanh toán
        $orderService = new OrderService();
        $result = $orderService->processOrder($paymentMethod, $_POST);
        ob_clean();
        echo json_encode($result);
    }

    public function testMomo()
    {
        $this->render("users/payment/testthanhtoanMomo");
        
    }

}