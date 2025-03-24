<?php

namespace core;

use core\Mail;
use app\Logger;
use mysql_xdevapi\Exception;



class OtpService
{

    public function generateOtp()
    {
        return rand(1000, 9999); //Tao otp
    }

    public function saveOtp($otp, $expiryMinutes = 1)
    {
        $_SESSION["otp"] = [
            'code' => $otp,
            'expires_at' => time() + ($expiryMinutes * 60) // Lưu thời gian hết hạn (giây)
        ];
    }

//    Check mã Otp có hợp lệ không
    public function isValidOtp($inputOtp)
    {
        $regex = '/^\d{4}$/';
       
        $currentTime = time();
        if(!preg_match($regex, $inputOtp)){
            return "Mã OTP phải đủ 4 số!";
        }
        elseif ($inputOtp != $_SESSION['otp']['code']) {
            return "Mã OTP không chính xác!";
        } elseif ($currentTime > $_SESSION['otp']['expires_at']) {
            return "Mã OTP đã hết hiệu lực!";
        } else return true;

    }

    public function sendOtp($email = null)
    {
        try {
            $mail = new Mail();
        } catch (\Exception $e) {
            echo "<div class='error-message'>" . $e->getMessage() . "</div>";
        }
        $to = $email ?? $_SESSION['register_data']['email'];

        if ($to) {
            $otp = $this->generateOtp(); // Tạo mã OTP
            $this->saveOtp($otp);


            // Đọc nội dung từ file HTML
            $template = file_get_contents(_DIR_ROOT . '/app/views/template/email_template.php');

            // Thay thế {{OTP}} trong file HTML thành mã OTP
            $email_template = str_replace('{{OTP}}', $otp, $template);


            $subject = 'OTP Code';
            $body = $email_template;

            try {
                $result = $mail->send($to, $subject, $body);
                if ($result === true) {

                    return true;
                }
            } catch (\Exception $e) {
                Logger::logError("Lỗi gửi mã OTP ở Mail" . $e->getMessage());
                throw new \Exception("Lỗi gửi mã OTP ở Mail");
            }
        } else {
            echo "Không tìm thấy email người dùng!";
        }


    }

    public function resendOTP($requestAjax, $email = null)
    {
//        debug
        // Tắt báo lỗi HTML để tránh làm hỏng JSON
        ini_set('display_errors', 0);
        error_reporting(0);

        // Kiểm tra yêu cầu AJAX
        if ($requestAjax === 'XMLHttpRequest') {
            // ưu tiên dùng email
            $email = $email ?? $_SESSION['register_data']['email'] ?? null;

            if ($email) {
                try {
//                    Kiểm tra và xóa mã otp cũ
                    if (isset($_SESSION["otp"])) {
                        unset($_SESSION["otp"]);
                    }
                    $result = $this->sendOtp($email); // Tạo và gửi lại OTP

                    if ($result) {


                        //  Dọn sạch output trước khi trả về JSON
                        ob_clean();
                        header('Content-Type: application/json');
                        $response = ['success' => true];
                        error_log("JSON Response: " . json_encode($response)); //  In log phản hồi JSON
                        echo json_encode($response);
                    }

                } catch (\Exception $e) {
                    ob_clean();
                    header('Content-Type: application/json');
                    echo json_encode(['success' => false, 'error' => 'Lỗi khi gửi mã OTP: ' . $e->getMessage()]);
                }
            } else {
                ob_clean();
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'error' => 'Không tìm thấy email người dùng!']);
            }
        } else {
            ob_clean();
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error' => 'Yêu cầu không hợp lệ!']);
        }
        exit();
    }

}