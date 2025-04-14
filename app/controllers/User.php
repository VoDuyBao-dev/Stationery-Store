<?php
require_once _DIR_ROOT . '/app/models/TransportModel.php';
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
                $this->render("users/Signin-Signout/otp", $messages);
                return;
            }
            // Xử lý tới đây rồi: chuyền mess vào để hiển thị lỗi và xóa bớt bên xử lý kia
            
            
        }
    }

    public function nhap_otp()
    {
       
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
        $result = $this->userModel->insertUser(
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
        // Tạo đường dẫn để đi đến trang đăng nhập của google.
        $googleService = new GoogleAuthService();
        $client = $googleService->getClient();
        $url = $client->createAuthUrl();
        
        $data = [
            'url' => $url
        ];

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
                //Nếu có cảnh báo đăng nhập quá số lần thì xóa khi nhập đúng mật khẩu
                if (isset($_SESSION['warning_signin'])) {
                    unset($_SESSION['warning_signin']);
                }
                // Kiểm tra tài khoản có bị khóa không
                if($verifyUser['status'] == 0){
                    $_SESSION['error'] = "Tài khoản của bạn đã bị khóa do hoạt động bất thường!";
                    header("Location: " . _WEB_ROOT . "/dang-nhap");
                    exit();
                }
                // Lấy thông tin người dùng
                $_SESSION['user'] = $verifyUser;
//                reset bộ đếm dăng nhập sai
                $_SESSION['signin_incorrect'] = 0;
                // xóa session old email
                unset($_SESSION['old_email']);

                if($verifyUser['role'] == 'admin'){
                    header("Location:" . _WEB_ROOT . "/admin_layout");
                    exit();
                }
                header("Location:" . _WEB_ROOT);
                exit();
            } else {
                $_SESSION['error'] = $verifyUser;
                $_SESSION['signin_incorrect']++;

                header("Location: " . _WEB_ROOT . "/dang-nhap");
                exit();
            }

        } 
        
        $this->render("users/Signin-Signout/signin", $data);
    
    }

    

    public function signout()
    {
        unset($_SESSION['user']);
        header("Location:" . _WEB_ROOT . "/dang-nhap");
        exit();
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

   // Lấy thông tin người dùng  qua trang thanh toán làm thông tin mặc đinhj
   public function UserInfor_Payment()
   {
        $transportModel = new TransportModel();
        $listTransport = $transportModel->getAllTransport();
        $data = [
            'listTransport' => $listTransport,
        ];
        $this->render("users/payment/Payment", $data);
       
   }

    // Xử lý form đc thông tin người dùng thanh toán do ajax gửi request lên
    public function handleUserInfor_Payment()
    {
        // Xử lý thông tin người dùng
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_SESSION['user']['user_id'];
            $sdt = $_POST['phone'];

            $result = $this->userModel->checkIDExists($id);
            if (!$result) {
                // Trả về lỗi nếu có vấn đề với thông tin người dùng
                ob_clean();
                echo json_encode(['success' => false, 'error' => 'Không tìm thấy người dùng trong hệ thống!']);
                exit();
            }

            $regex = '/^(0|\+84)(\d{9,10})$/';
            if (!preg_match($regex, $sdt)) {
                ob_clean();
                echo json_encode(['success' => false, 'error' => 'Số điện thoại không hợp lệ. Vui lòng kiểm tra lại!']);
                exit();
            }

            ob_clean();
            // Tiếp tục xử lý thông tin nếu không có lỗi
            echo json_encode(['success' => true]);
        }
    }


    public function editInfomation()
    {
        if(isset($_POST['submit'])){
            $name = htmlspecialchars(trim($_POST['name'] ?? ''));
            $sdt = htmlspecialchars(trim($_POST['phone'] ?? ''));
            $address = htmlspecialchars(trim($_POST['address'] ?? '')) ;
            $user_id = htmlspecialchars(trim($_POST['user_id'] ?? ''));
            $hasError = false;
            

            $regex = '/^(0|\+84)(\d{9,10})$/';
            if (!preg_match($regex, $sdt)) {
                Helpers::setFlash('error_sdt', 'Số điện thoại không hợp lệ!');
                $hasError = true;
            }else{
                $checkSDT = $this->userModel->checkSDTExists($sdt);
                if($checkSDT === true){
                    Helpers::setFlash('error_address', 'Số điện thoại này đã được đăng ký.');
                    $hasError = true;
                }
            }


            if (empty($address)) {
                Helpers::setFlash('error_address', 'Vui lòng nhập địa chỉ.');
                $hasError = true;
                
            } elseif (strlen($address) < 5 || strlen($address) > 255) {
                Helpers::setFlash('error_address', 'Địa chỉ phải từ 5 đến 255 ký tự.');
                $hasError = true;
                
            } 

            if( $hasError === true){
                $this->render("users/setting/chinhsuathongtin");
                return;
            }

            // đúng hết thì cập nhật thông tin
            $updateInfo = $this->userModel->updateInformation($name, $sdt, $address, $user_id);
            if(!$updateInfo){
                Helpers::setFlash('notification', ['type' => 'error', 'message' => 'Cập nhật thông tin người dùng thất bại!']);
                $this->render("users/setting/chinhsuathongtin");
                return;
            }
            // cập nhật session:
            $newInfo = $this->userModel->getUserById($user_id);
            if(!$newInfo){
                Logger::logError("Không lấy được người dùng vừa cập nhật thông tin");
            }else{
                $_SESSION['user'] = $newInfo;
            }

            Helpers::setFlash('notification', ['type' => 'success', 'message' => 'Cập nhật thông tin người dùng thành công!']);
            header("Location: " . _WEB_ROOT . "/chinh-sua-thong-tin");
            exit();

        }
        $this->render("users/setting/chinhsuathongtin");
    }
   


    
   public function reply()
    {
        $this->render("users/reply/reply");
    }

   
}
