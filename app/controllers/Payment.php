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
       

        if( $paymentMethod === "cod"){
            // thanh toán khi nhận hàng thì không xử lý gì thêm
            $this->finalizePayment($paymentMethod);
            return;
        }
        else if($paymentMethod === "ewallet"){
            // xử lí phương thức thanh toán Momo
            $momoMethod = $_POST['momo_method'];
            if($momoMethod === 'momo_qr'){
                $momoPaymentProcessing = new MomoPaymentProcessing();
                $result = $momoPaymentProcessing->confirmMomo_QR();
                ob_clean();
                echo json_encode($result);
                return;
               

            }else if($momoMethod === 'momo_bank'){
                $momoPaymentProcessing = new MomoPaymentProcessing();
                $result = $momoPaymentProcessing->confirmMomo_ATM();
                ob_clean();
                echo json_encode($result);
                return;

            }
           

            
        }
        else if($paymentMethod === "bank"){
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
        $vnpaySuccess = $_GET['vnpay_success'] ?? null;
        if (isset($vnpaySuccess) && ($vnpaySuccess != 0)) {
            $payment_id = $vnpaySuccess;
            $this->finalizePayment($paymentMethod,$payment_id);
        } else {
            $message_error = $_GET['message_error'] ?? "";
            $message = (isset($message_error)) ? $message_error : "Lưu thông tin hóa đơn VNPay thất bại!";
            header("Location:" . _WEB_ROOT . "/thanh-toan?success=false&message=". urlencode($message));
            exit;
        }    
    }   

    public function handleMomoCallback()
    {
        $paymentMethod = 'ewallet';
        $momoSuccess = $_GET['momo_success'] ?? null;
        if (isset($momoSuccess) && ($momoSuccess != 0)) {
            $payment_id = $momoSuccess;
            $this->finalizePayment($paymentMethod,$payment_id);
        } else {
            $message = "Lưu thông tin hóa đơn Momo thất bại!";
            header("Location:" . _WEB_ROOT . "/thanh-toan?success=false&message=". urlencode($message));
            exit;
        }    
    }

    private function finalizePayment($paymentMethod, $payment_id = null) {
        $orderData = $_SESSION['order_data'] ?? [];
        unset($_SESSION['order_data']);
        // Gọi service để xử lý đơn hàng và thanh toán
        $orderService = new OrderService();
        $result = $orderService->processOrder($paymentMethod, $orderData, $payment_id);

        if($paymentMethod === 'bank') {
            // VNPay callback - sử dụng header redirect
            if($result['success']) {
                header("Location:" . _WEB_ROOT . "/thanh-toan?success=true&message=" . urlencode($result['message']));
            } else {
                header("Location:" . _WEB_ROOT . "/thanh-toan?success=false&message=" . urlencode($result['message']));
            }
            exit;
        } elseif($paymentMethod === 'cod') {
            // COD/AJAX - trả về JSON response
            ob_clean();
            echo json_encode([
                'success' => $result['success'],
                'message' => $result['message'],
                'redirect' => _WEB_ROOT . "/thanh-toan?success=" . 
                             ($result['success'] ? 'true' : 'false') . 
                             "&message=" . urlencode($result['message'])
            ]);
        }else if($paymentMethod === 'ewallet') {
           
            if($result['success']) {
                header("Location:" . _WEB_ROOT . "/thanh-toan?success=true&message=" . urlencode($result['message']));
            } else {
                header("Location:" . _WEB_ROOT . "/thanh-toan?success=false&message=" . urlencode($result['message']));
            }
            exit;
        }
    }

    public function testMomo()
    {
        $this->render("users/payment/testthanhtoanMomo");
        
    }



}