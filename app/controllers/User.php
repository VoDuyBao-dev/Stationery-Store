<?php

use core\OtpService;

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
            header("Location:" . _BASE_URL . "/app/errors/loichung.php?message=" . urlencode($e->getMessage()));
            exit;
        }

    }


    public function register()
    {

        if (isset($_POST['submit'])) {
            $ho = htmlspecialchars(trim($_POST['ho']));
            $ten = htmlspecialchars(trim($_POST['ten']));
            $sdt = htmlspecialchars(trim($_POST['sdt']));
            $email = strtolower(htmlspecialchars(trim($_POST['email'])));
            $password = htmlspecialchars(trim($_POST['password']));

            $messages = [

                'old_ho' => $ho,
                'old_ten' => $ten,
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

            //            check sdt
            if ($this->userModel->checkSDTExists($sdt)) {
                $messages['error_sdt'] = "Số điện thoại đã tồn tại!";
            }
//        check email
            if ($this->userModel->checkEmailExists($email)) {
                $messages['error_email'] = "Email đã tồn tại!";
            }

            if (!empty($messages['error_sdt']) || !empty($messages['error_email'])) {
                $this->render("users/register", $messages);
                return;
            }
//            hash password
            $password = password_hash($password, PASSWORD_DEFAULT);

            $_SESSION['register_data'] = compact('ho', 'ten', 'sdt', 'email', 'password');
//            Gửi mã otp
            $otpService = new OtpService();
            try {
                $otpService->sendOtp();
                if ($otpService) {
                    header("Location: nhap-otp");
                    exit();
                }
            } catch (\Exception $e) {
                $messages['fail'] = $e->getMessage();
                $this->render("users/register", $messages);
            }


        } else {
            $this->render("users/register");
        }

    }

    public function verifyOTP()
    {

        if (isset($_POST['submit'])) {
            $enteredOtp = implode('', $_POST['otp']);
            $messages = [];
            $result = false;

            $regex = '/^\d{6}$/';
            if (!preg_match($regex, $enteredOtp)) {
                $messages['error_otp'] = "Mã OTP phải có 6 chữ số!";
                $this->render("users/otp", $messages);
                return;
            }

            $otpService = new OtpService();
            $otpIsValid = $otpService->isValidOtp($enteredOtp);
            if ($otpIsValid === true) {
                $data = $_SESSION['register_data'];
                $result = $this->userModel->createUser(
                    $data['ho'],
                    $data['ten'],
                    $data['sdt'],
                    $data['email'],
                    $data['password']

                );
            } else {
                $messages['error_otp'] = $otpIsValid;
                $this->render("users/otp", $messages);
                return;
            }

            if ($result === true) {
                unset($_SESSION["otp"]);
                unset($_SESSION['register_data']);
                $messages['create_success'] = 1;
                $this->render("users/signin", $messages);
                exit();
            } else {
                $messages['$create_user'] = $result;
                $this->render("users/otp", $messages);
                return;
            }


        } else {
            $this->render("users/otp");
        }


    }

    public function resendOTP()
    {
        $requestAjax = $_SERVER['HTTP_X_REQUESTED_WITH'];
        $otpService = new OtpService();
        $otpService->resendOTP($requestAjax);

    }

    public function signin()
    {

        if (isset($_POST['submit-signin'])) {
            $email = strtolower(htmlspecialchars(trim($_POST['email'])));
            $password = htmlspecialchars(trim($_POST['password']));

            $_SESSION['old_email'] = $email;
// đếm số lần đăng nhập sai
            if (!isset($_SESSION['signin_incorrect'])) {
                $_SESSION['signin_incorrect'] = 0;
            }
            if ($_SESSION['signin_incorrect'] >= 3) {
                if (!isset($_SESSION['warning_signin'])) {
                    $_SESSION['warning_signin'] = "Bạn đã nhập sai quá 3 lần. Vui lòng dùng quên mật khẩu!";
                }

            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = "Email của bạn không hợp lệ!";
                header("Location: " . _WEB_ROOT . "/dang-nhap");
                exit();

            }
            $verifyUser = $this->userModel->verifyUser($email, $password);
            if (is_array($verifyUser)) {
                $_SESSION['user'] = $verifyUser;
//                reset bộ đếm dăng nhập sai
                $_SESSION['signin_incorrect'] = 0;
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

        } else {
            $_SESSION['signin_incorrect'] = 0;
            $this->render("users/signin");
        }


    }


}