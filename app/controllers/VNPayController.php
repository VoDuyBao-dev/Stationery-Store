<?php
class VNPayController extends Controller {
    private $vnpayService;

    public function __construct() {
        $this->vnpayService = new VNPayPaymentProcessing();
    }

    public function vnpay_post(){
        if(isset($_GET['vnp_ResponseCode'])){
            if($_GET['vnp_ResponseCode'] == 00){
                $information = $_GET;
                $information_json = json_encode($information);
               
                $payment_id = $this->vnpayService->savePaymentInformation($information_json);
                if(is_numeric($payment_id)){
                    // trả về id của payment information vừa thêm
                    header("Location:" . _WEB_ROOT . "/handleVNPayCallback?vnpay_success=$payment_id");
                    exit;
                }
            }else{
                header("Location:" . _WEB_ROOT . "/handleVNPayCallback?vnpay_success=0&message_error=Thanh toán thất bại!");
                exit;
            }
           

        }
        // nếu có lỗi trả về 0 tương đương false
        header("Location:" . _WEB_ROOT . "/handleVNPayCallback?vnpay_success=0");
        exit;
        
        
    }

    
}
?>