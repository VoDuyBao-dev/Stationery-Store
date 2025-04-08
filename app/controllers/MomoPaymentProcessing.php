<?php
require_once _DIR_ROOT . '/configs/ConfigLoader.php';

class MomoPaymentProcessing extends Controller
{
    public function __construct()
    {
        header('Content-type: text/html; charset=utf-8');
    }
    
    private function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    // Hàm xử lý thanh toán MoMo QR code
    public function processPayment_QRCode()
    {
        
        $configMomo = ConfigLoader::load(_DIR_ROOT . '/configs/configMomo.json');

        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";


        $partnerCode = $configMomo['partnerCode'];
        $accessKey = $configMomo['accessKey'];
        $secretKey = $configMomo['secretKey'];
       
        $orderInfo = "Thanh toán qua MoMo QR code";
        $amount = "100000";
        $orderId = time() ."";
        $redirectUrl = _WEB_ROOT."/thanh-toan";
        $ipnUrl = _WEB_ROOT."/thanh-toan";
        $extraData = "";

        $requestId = time() . "";
        $requestType = "captureWallet";
    
        // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
        
        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
       
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array('partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature);
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);  // decode json
        //Just a example, please check more in there

       // Chuyển hướng người dùng đến URL thanh toán của MoMo
       
        header('Location: ' . $jsonResult['payUrl']);
          
    }

    // Hàm xử lý thanh toán MoMo ATM
    public function processPayment_ATM()
    {
        $configMomo = ConfigLoader::load(_DIR_ROOT . '/configs/configMomo.json');

        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

        $partnerCode = $configMomo['partnerCode'];
        $accessKey = $configMomo['accessKey'];
        $secretKey = $configMomo['secretKey'];
       
        $orderInfo = "Thanh toán qua MoMo ATM";
        $amount = "100000";
        $orderId = time() ."";
        $redirectUrl = _WEB_ROOT."/thanh-toan";
        $ipnUrl = _WEB_ROOT."/thanh-toan";
        $extraData = "";
        $requestId = time() . "";
        $requestType = "payWithATM";
    //     $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array('partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature);
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);  // decode json

        //Just a example, please check more in there

        header('Location: ' . $jsonResult['payUrl']);
          
    }


    


   


   
    
    


        
    
        
}
?>