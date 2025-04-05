<?php

use App\Logger;
use core\OtpService;
use core\Helpers;

class User extends Controller
{
    private $userModel;

    public function __construct()
    {
        try {
            $this->userModel = $this->model('UserModel');

            if (!$this->userModel) {
                throw new Exception("Lỗi trong quá trình tạo đối tượng");
            }
        } catch (Exception $e) {
            header("Location:" . _WEB_ROOT . "/app/errors/loichung.php?message=" . urlencode($e->getMessage()));
            exit;
        }

    }

    public function handle_action_OTP(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? 'default';
            echo $action;
            $otp = implode('', $_POST['otp']);
            $otpService = new OtpService();
            $otpIsValid = $otpService->isValidOtp($otp);
            $messages = [];
            if($otpIsValid === true){
                switch ($action) {
                    case 'register_user':
                       $this->registerUser($messages);
                        break;
                    case 'change_password':
                        $this->change_password();
                        break;
                    default:
                        header("Location:" . _WEB_ROOT . "/app/errors/loichung.php?message=Action không hợp lệ! $action" );
                        exit();
                       
                }     
            }else {
                $messages['error_otp'] = $otpIsValid;
                $this->render("users/otp", $messages);
                return;
            }
            // Xử lý tới đây rồi: chuyền mess vào để hiển thị lỗi và xóa bớt bên xử lý kia
            
            
        }
    }

    public function nhap_otp()
    {
        echo "1111";
        $this->render("users/Signin-Signout/otp");
    }

    public function register()
    {

        if (isset($_POST['submit'])) {
            $fullname = htmlspecialchars(trim($_POST['fullname']));
            $sdt = htmlspecialchars(trim($_POST['sdt']));
            $email = strtolower(htmlspecialchars(trim($_POST['email'])));
            $password = htmlspecialchars(trim($_POST['password']));
            $confirmPassword = htmlspecialchars(trim($_POST['confirm-password']));

            $messages = [

                'old_fullname' => $fullname,
                'old_sdt' => $sdt,
                'old_email' => $email,

            ];
//            check std
            $regex = '/^(0|\+84)(\d{9,10})$/';
            if (!preg_match($regex, $sdt)) {
                $messages['error_sdt'] = "Số điện thoại không hợp lệ!";

            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $messages['error_email'] = "Email của bạn không hợp lệ!";

            }

            if($password !== $confirmPassword){
                $messages['error_confirmPassword'] = "Mật khẩu không khớp!";
            }

            //            check sdt
            if ($this->userModel->checkSDTExists($sdt)) {
                $messages['error_sdt'] = "Số điện thoại đã tồn tại!";
            }
//        check email
            if ($this->userModel->checkEmailExists($email)) {
                $messages['error_email'] = "Email đã tồn tại!";
            }

            if (!empty($messages['error_sdt']) || !empty($messages['error_email']) || !empty($messages['error_confirmPassword'])) {
                $this->render("users/Signin-Signout/register", $messages);
                return;
            }
//            hash password
            $password = password_hash($password, PASSWORD_DEFAULT);

            $_SESSION['register_data'] = compact('fullname', 'sdt', 'email', 'password');
//            Gửi mã otp
            $otpService = new OtpService();
            try {
                $otpService->sendOtp();
                if ($otpService) {
                    header("Location: nhap-otp?action=register_user");
                    exit();
                }
            } catch (\Exception $e) {
                $_SESSION['fail'] = $e->getMessage();
                header("Location: " . _WEB_ROOT . "/dang-ky");
                exit();
                
            }
           


        } else {
            $this->render("users/Signin-Signout/register");
        }

    }

    public function registerUser($messages=[])
    {

        $result = false;

        $data = $_SESSION['register_data'];
        $result = $this->userModel->createUser(
            $data['fullname'],
            $data['sdt'],
            $data['email'],
            $data['password']

        );
        

        if ($result === true) {
            unset($_SESSION["otp"]);
            unset($_SESSION['register_data']);
            Helpers::setFlash('success', 'Đăng ký thành công!');
            header("Location:" . _WEB_ROOT . "/dang-nhap");
            exit();
        } else {
            $messages['$create_user'] = $result;
            $this->render("users/Signin-Signout/otp", $messages);
            return;
        }


    }

    public function resendOTP($email = null)
    {
        $requestAjax = $_SERVER['HTTP_X_REQUESTED_WITH'];
        $otpService = new OtpService();
        $otpService->resendOTP($requestAjax, $email);

    }

    public function signin_incorrect()
    {
        // đếm số lần đăng nhập sai
        if (!isset($_SESSION['signin_incorrect'])) {
            $_SESSION['signin_incorrect'] = 0;
        }

        // Xóa cảnh báo nếu đã hết hạn
        if (isset($_SESSION['warning_signin_expire']) && time() > $_SESSION['warning_signin_expire']) {
            unset($_SESSION['warning_signin']);
            unset($_SESSION['warning_signin_expire']);
        }
        
        if ($_SESSION['signin_incorrect'] >= 2) {
            if (!isset($_SESSION['warning_signin'])) {
                $_SESSION['warning_signin'] = "Bạn đã nhập sai quá 3 lần. Vui lòng dùng quên mật khẩu!";
                // Đặt thời gian hết hạn là 3 phút kể từ bây giờ
                $_SESSION['warning_signin_expire'] = time() + (3 * 60);
            }

        }
    }

    public function signin()
    {

        if (isset($_POST['submit-signin'])) {
            $email = strtolower(htmlspecialchars(trim($_POST['email'])));
            $password = htmlspecialchars(trim($_POST['password']));

            $_SESSION['old_email'] = $email;

            $this->signin_incorrect();

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = "Email của bạn không hợp lệ!";
                header("Location: " . _WEB_ROOT . "/dang-nhap");
                exit();

            }
            $verifyUser = $this->userModel->verifyUser($email, $password);
            if (is_array($verifyUser)) {
                // Lấy thông tin người dùng
                $_SESSION['user'] = $verifyUser;
//                reset bộ đếm dăng nhập sai
                $_SESSION['signin_incorrect'] = 0;
                // xóa session old email
                unset($_SESSION['old_email']);
//                Nếu có cảnh báo đăng nhập quá số lần thì xóa khi đăng nhập thành công
                if (isset($_SESSION['warning_signin'])) {
                    unset($_SESSION['warning_signin']);
                }
                header("Location:" . _WEB_ROOT . "/home");
                exit();
            } else {
                $_SESSION['error'] = $verifyUser;
                $_SESSION['signin_incorrect']++;

                header("Location: " . _WEB_ROOT . "/dang-nhap");
                exit();
            }

        } 
        
        $this->render("users/Signin-Signout/signin");
    
    }


    public function forgot_pass()
    {
        if (isset($_POST['submit'])) {
            $email = strtolower(htmlspecialchars(trim($_POST['email'])));
            $_SESSION['oldEmail_forgotPass'] = $email;

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = "Email của bạn không hợp lệ!";
                header("Location: " . _WEB_ROOT . "/forgot_pass");
                exit();
            }
            
            $checkEmail = $this->userModel->checkEmailExists($email);
            if(!$checkEmail){
                $_SESSION['error'] = "Email chưa được đăng ký trên hệ thống. Vui lòng kiểm tra lại!";
                header("Location: " . _WEB_ROOT . "/forgot_pass");
                exit();

            }

           $_SESSION['email'] = $email;
            $otpService = new OtpService();
            try {
                $otpService->sendOtp($email);
                if($otpService){
                    header("Location: nhap-otp?action=change_password");
                    exit();
                }
            } 
            catch (\Exception $e) {
                $_SESSION['fail'] = $e->getMessage();
                header("Location: " . _WEB_ROOT . "/forgot_pass");
                exit();
                
            }
           
        }
        $this->render("users/Signin-Signout/forgot_pass");
    }

    public function change_password(){
        if(isset($_POST['submit-newPass']) ){
            $newPassword = trim($_POST['newPassword']);
            $confirmPassword = trim($_POST['conf_new_password']);
            if($newPassword !== $confirmPassword){
                $_SESSION['error'] = "Mật khẩu không khớp!";
                header("Location: " . _WEB_ROOT . "/change_password");
                exit();
            }

            $hashPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            
            if(!isset($_SESSION['email'])){
                header("Location:" . _WEB_ROOT . "/app/errors/loichung.php?message=Không tìm thấy tài khoản cần đổi password!" );
                exit();
            }
            $result = $this->userModel->changePassword($_SESSION['email'], $hashPassword);
            if($result === true){
                unset($_SESSION['email']);
                Helpers::setFlash('success', 'Đổi mật khẩu thành công!');
                unset( $_SESSION['oldEmail_forgotPass']);
                header("Location:" . _WEB_ROOT . "/dang-nhap");
                exit();
            }else{
                $_SESSION['error'] = $result;
                header("Location: " . _WEB_ROOT . "/change_password");
                exit();
            }

        }   
        $this->render("users/Signin-Signout/newpass");
    }


    public function home()
    {
        $this->render("users/index");
    }


    public function thongtin()
    {
        $this->render("products/Thongtinchitiet");
    }

    // public function listuser()
    // {
    //     $users = $this->userModel->getAllUsers();
    //     $usersLock = $this->userModel->getAllUsersLock();
    //     if(!empty($users)){
    //         $this->render("users/listuser", ["users" => $users, "usersLock" => $usersLock]);
    //     }else{
    //         Logger::logError("Không tìm thấy người dùng nào trong hệ thống!");
    //         header("Location:" . _WEB_ROOT . "/home");
    //         exit();
    //     }

        
    // }


    // public function unlockUser(){
    //     if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST'){
    //         $id = $_POST['id'] ?? null;
    //         if($id === null || !is_numeric($id) || $id <= 0){
    //             $_SESSION['error'] = "ID không hợp lệ!";
    //             header("Location:" . _WEB_ROOT . "/user/listuser");
    //             exit();
    //         }
    //         $id = (int)$id;
    
    //         $user = $this->userModel->getUserById($id);
    //         if($user === false){
    //             $_SESSION['error'] = "Không tìm thấy người dùng cần mở khóa!";
    //             header("Location:" . _WEB_ROOT . "/user/listuser");
    //             exit();
    //         }
    //         $result = $this->userModel->unlockUser($id);
    //         if($result){
    //             $_SESSION['message'] = "Mở khóa người dùng thành công!";
    //             header("Location:" . _WEB_ROOT . "/user/listuser");
    //             exit();
    //         }else{
    //             $_SESSION['error'] = "Xóa người dùng thất bại!";
    //             header("Location:" . _WEB_ROOT . "/user/listuser");
    //             exit();
    //         }
    //     }
    //     Logger::logError("Lỗi ở method POST. Không có dữ liệu để mở khóa người dùng!");
    //     header("Location:" . _WEB_ROOT . "/user/listuser");
    //     exit();
       
    // }


    // public function lockUser(){
    //     if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST'){
    //         $id = $_POST['id'] ?? null;
    //         if($id === null || !is_numeric($id) || $id <= 0){
    //             $_SESSION['error'] = "ID không hợp lệ!";
    //             header("Location:" . _WEB_ROOT . "/user/listuser");
    //             exit();
    //         }
    //         $id = (int)$id;
    
    //         $user = $this->userModel->getUserById($id);
    //         if($user === false){
    //             $_SESSION['error'] = "Không tìm thấy người dùng cần xóa!";
    //             header("Location:" . _WEB_ROOT . "/user/listuser");
    //             exit();
    //         }
    //         $result = $this->userModel->lockUser($id);
    //         if($result){
    //             $_SESSION['message'] = "Khóa người dùng thành công!";
    //             header("Location:" . _WEB_ROOT . "/user/listuser");
    //             exit();
    //         }else{
    //             $_SESSION['error'] = "Khóa người dùng thất bại!";
    //             header("Location:" . _WEB_ROOT . "/user/listuser");
    //             exit();
    //         }
    //     }
    //     Logger::logError("Lỗi ở method POST. Không có dữ liệu để khóa người dùng!");
    //     header("Location:" . _WEB_ROOT . "/user/listuser");
    //     exit();
       
    // }

   


    public function payment()
    {
        $this->render("users/payment/Payment");
    }

   public function reply()
    {
        $this->render("users/reply/reply");
    }

    public function search()
    {
        $this->render("users/search/ketquatimkiem");
    }
    public function notfound()
    {
        $this->render("users/search/notfound");
    }
}
