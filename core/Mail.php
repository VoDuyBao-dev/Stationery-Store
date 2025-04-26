<?php

namespace core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use app\Logger;

require_once __DIR__ . '/../app/libraries/google-api-php-client/vendor/autoload.php';
class Mail
{
    private $mail;

//    chú ý bắt các exception này
    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        try {
            // Cấu hình SMTP
            $this->mail->isSMTP();
            $this->mail->Host = 'smtp.gmail.com'; // SMTP Server (ví dụ: Gmail)
            $this->mail->SMTPAuth = true;
            $this->mail->Username = 'sancaulongnhom6@gmail.com'; // Tài khoản email
            $this->mail->Password = 'wiorrhajexjqvayt'; // Mật khẩu ứng dụng (App password)
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mail->Port = 587;

            // Cài đặt mặc định cho email
            $this->mail->setFrom('sancaulongnhom6@gmail.com', 'Stationery Store'); // Email và tên người gửi
            $this->mail->isHTML(true); // Cho phép nội dung HTML
        } catch (\Exception $e) {
            Logger::logError(("Lỗi cấu hình email: " . $e->getMessage()));
            throw new \Exception("Không thể cấu hình email. Vui lòng thử lại sau.");
        }
    }

    public function send($to, $subject, $body)
    {
        try {
            $this->mail->addAddress($to);
            $this->mail->Subject = $subject;
            $this->mail->Body = $body;

            $this->mail->send();
            return true;
        } catch (\Exception $e) {
            Logger::logError("Lỗi gửi email: " . $e->getMessage());
            throw new \Exception ("Lỗi gửi email");
        }
    }


}