<?php
use App\Logger;
use Google\Service\Oauth2 as Google_Service_Oauth2;
class GoogleController extends Controller
{
    private $GoogleService;

    public function __construct()
    {
        // Thêm parent::__construct()
        // parent::__construct();
        $this->GoogleService = new GoogleAuthService();
       
    }

    // Đăng nhập bằng google
    public function handleLogin_google() {
        $client = $this->GoogleService->getClient();
        $service = new Google_Service_Oauth2($client);

        if(isset($_GET['code'])) {
            try {
                // Lấy access token từ authorization code
                $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
                $client->setAccessToken($token);

                // Kiểm tra token có lỗi không
                if(array_key_exists('error', $token)) {
                    throw new Exception('Error: ' . $token['error_description']);
                }

                // Lấy thông tin user
                $google_user = $service->userinfo->get();
                // print_r($google_user);
                // Xử lý thông tin user
                $email = $google_user->email;
                $name = $google_user->name;
                $google_id = $google_user->id;
                
                $checkUserExists = $this->GoogleService->checkThongTin($email);
                var_dump($checkUserExists);
                if(!$checkUserExists){
                    $insertUser = $this->GoogleService->insert_UserGoogle($name,$email,$google_id);
                    if($insertUser !== true){
                        $_SESSION['error'] = $insertUser;
                        header('Location: ' . _WEB_ROOT . '/dang-nhap');
                        exit();
                    }
                    $getInfoUser = $this->GoogleService->getInfo_userGoogle($email);
                    if(!$getInfoUser){
                        Logger::logError("Không lấy được thông tin của người dùng đăng nhập bằng google có email: $email");
                        $_SESSION['error'] = "Lỗi đăng nhập bằng Google";
                        header('Location: ' . _WEB_ROOT . '/dang-nhap');
                        exit();
                    }else{
                        $_SESSION['user'] = $getInfoUser;
                        // check admin hay user
                        // nếu là user thì về trang chủ của user
                        $this->validateAdmin();
                        // còn là admin thì đến trang admin
                        header('Location: ' . _WEB_ROOT . "/admin_layout");
                        exit();
                    }
                    

                }else{
                    // nếu có người dùng ròi
                    // lấy thông tin ng dùng đưa vào session
                    $_SESSION['user'] = $checkUserExists;
                    // check admin hay user
                    // nếu là user thì về trang chủ của user
                    $this->validateAdmin();
                    // còn là admin thì đến trang admin
                    header('Location: ' . _WEB_ROOT . "/admin_layout");
                    exit();
                }

              
                
            } catch(Exception $e) {
                $_SESSION['error'] = $e->getMessage();
                header('Location: ' . _WEB_ROOT . '/dang-nhap');
                exit();
            }
        } else {
            header('Location: ' . _WEB_ROOT . '/dang-nhap'); 
            exit();
        }
       
    }
}
?>