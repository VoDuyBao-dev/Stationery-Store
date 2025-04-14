<?php
use App\Logger;
class MomoController extends Controller {
   
    private $MomoService;

    public function __construct() {
        $this->MomoService = new MomoPaymentProcessing();
    }
    
    public function handleMoMo_IPN() {
        
    }

    public function handleMoMo_Redirect(){
        
        if(isset($_GET['resultCode'])){
            switch ($_GET['resultCode']){
                case 0:{
                    $information = $_GET;
                    $information_json = json_encode($information);
                
                    $payment_id = $this->MomoService->savePaymentInformation($information_json);
                    if(is_numeric($payment_id)){
                        // trả về id của payment information vừa thêm
                        header("Location:" . _WEB_ROOT . "/handleMomoCallback?momo_success=$payment_id");
                        exit;
                    }else{
                        Logger::logError("Lỗi lấy về id của savePaymentInformation trong hàm handleMoMo_Redirect");
                        $message = "Lỗi khi lưu thông tin thanh toán";
                        header("Location:" . _WEB_ROOT . "/thanh-toan?success=false&message=" . urlencode($message));
                        exit; 
                    }
                 
                }
                case 1001:{
                    
                    $message = "Giao dịch thanh toán thất bại do tài khoản người dùng không đủ tiền!";
                    header("Location:" . _WEB_ROOT . "/thanh-toan?success=false&message=" . urlencode($message));
                    exit;
                }
                case 1006:{
                   
                    $message = "Giao dịch thất bại do người dùng đã từ chối xác nhận thanh toán!";
                    header("Location:" . _WEB_ROOT . "/thanh-toan?success=false&message=" . urlencode($message));
                    exit;
                }
                default:{

                }
                    

            }
               
        }else{
            // Chuyển về trang thất bại
            $message = isset($_GET['message']) ? $_GET['message'] : "Thanh toán thất bại!";
            header("Location:" . _WEB_ROOT . "/thanh-toan?success=false&message=" . urlencode($message));
            exit();
        }
        
        
    }


}
?>