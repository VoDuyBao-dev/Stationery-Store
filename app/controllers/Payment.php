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
        // lưu thông tin form vào session để dùng cho lưu thông tin
        $_SESSION['order_data'] = $_POST;
       

        // if( $paymentMethod === "cod"){
        //     // thanh toán khi nhận hàng thì không xử lý gì thêm
        //     $this->finalizePayment($paymentMethod);
        // }
        // else if($paymentMethod === "ewallet"){
        //     // xử lí phương thức thanh toán Momo
        //     $momoMethod = $_POST['momo_method'];
        //     if($momoMethod === 'qr'){
        //         $success = true;
        //         if ($success) {
        //             ob_clean();
        //             $this->finalizePayment($paymentMethod);
        //         } else {
        //             ob_clean();
        //             echo json_encode(['success' => false, 'message' => 'Thanh toán Momo bằng quét mã QR thất bại!']);
        //         }

        //     }else if($momoMethod === 'bank'){
        //         $success = false;
        //         if ($success) {
        //             ob_clean();
        //             $this->finalizePayment($paymentMethod);
        //         } else {
        //             ob_clean();
        //             echo json_encode(['success' => false, 'message' => 'Thanh toán Momo bằng thẻ ngân hàng thất bại!']);
        //         }

        //     }
           

            
        // }
        if($paymentMethod === "bank"){
            // xu lí VNPay
            $vnpayPaymentProcessing = new VNPayPaymentProcessing();
            $result = $vnpayPaymentProcessing->confirm_vnpay();
            if(isset($result['data'])) {
                ob_clean();
                echo json_encode([
                    'success' => true,
                    'data' => $result['data']  // URL VNPay để JavaScript redirect
                ]);
            }
            return;
               
        }
        else{
            ob_clean();
            echo json_encode(['success' => false, 'message' => 'Phương thức không hợp lệ']);
        }
    
        
        
    }


    public function handleVNPayCallback()
    {
        $paymentMethod = 'bank';
        echo "1";
        $vnpaySuccess = $_GET['vnpay_success'] ?? null;
        if (isset($vnpaySuccess) && ($vnpaySuccess != 0)) {
            $payment_id = $vnpaySuccess;
            $this->finalizePayment($paymentMethod,$payment_id);
        } else {
            $message = "thanh toán đơn hàng thất bại!";
            header("Location:" . _WEB_ROOT . "/thanh-toan?success=false&message=". urlencode($message));
            exit;
        }    
    }

    private function finalizePayment($paymentMethod, $payment_id = null)
    {
         // Lấy thông tin đơn hàng từ session
        $orderData = $_SESSION['order_data'] ?? [];
        // Gọi service để xử lý đơn hàng và thanh toán
        $orderService = new OrderService();
        $result = $orderService->processOrder($paymentMethod, $orderData, $payment_id);
        unset($_SESSION['order_data']);

        ob_clean();
        echo json_encode($result);
    }

    public function testMomo()
    {
        $this->render("users/payment/testthanhtoanMomo");
        
    }



}