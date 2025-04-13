<?php
use App\Logger;
use core\Helpers;
class AdminManageUser extends Controller
{
    private $adminModel;

    public function __construct()
    {
        try {
            $this->adminModel = $this->model('UserModel');

            if (!$this->adminModel) {
                throw new Exception("Lỗi trong quá trình tạo đối tượng");
            }
        } catch (Exception $e) {
            header("Location:" . _WEB_ROOT . "/app/errors/loichung.php?message=" . urlencode($e->getMessage()));
            exit;
        }

    }
   

    public function listuser()
    {
        $users = $this->adminModel->getAllUsers();
        $usersLock = $this->adminModel->getAllUsersLock();
        $data = [
            "users" => $users, 
            "usersLock" => $usersLock
        ];
        $this->render("admin/customers/Taikhoan", $data);
    }


    public function unlockUser(){
        if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'] ?? null;
            if($id === null || !is_numeric($id) || $id <= 0){
                Helpers::setFlash('error', 'ID không hợp lệ!');
                header("Location:" . _WEB_ROOT . "/manage_users");
                exit();
            }
            $id = (int)$id;
    
            $user = $this->adminModel->getUserById($id);
            if($user === false){
                Helpers::setFlash('error', 'Không tìm thấy người dùng cần mở khóa!');
               
                header("Location:" . _WEB_ROOT . "/manage_users");
                exit();
            }
            $result = $this->adminModel->unlockUser($id);
            if($result){
                Helpers::setFlash('message', 'Mở khóa người dùng thành công!');
               
                header("Location:" . _WEB_ROOT . "/manage_users");
                exit();
            }else{
                Helpers::setFlash('error', 'Xóa người dùng thất bại!');
                
                header("Location:" . _WEB_ROOT . "/manage_users");
                exit();
            }
        }
        Logger::logError("Lỗi ở method POST. Không có dữ liệu để mở khóa người dùng!");
        header("Location:" . _WEB_ROOT . "/manage_users");
        exit();
       
    }


    public function lockUser(){
        if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'] ?? null;
            if($id === null || !is_numeric($id) || $id <= 0){
                $_SESSION['error'] = "ID không hợp lệ!";
                header("Location:" . _WEB_ROOT . "/manage_users");
                exit();
            }
            $id = (int)$id;
    
            $user = $this->adminModel->getUserById($id);
            if($user === false){
                $_SESSION['error'] = "Không tìm thấy người dùng cần xóa!";
                header("Location:" . _WEB_ROOT . "/manage_users");
                exit();
            }
            $result = $this->adminModel->lockUser($id);
            if($result){
                $_SESSION['message'] = "Khóa người dùng thành công!";
                header("Location:" . _WEB_ROOT . "/manage_users");
                exit();
            }else{
                $_SESSION['error'] = "Khóa người dùng thất bại!";
                header("Location:" . _WEB_ROOT . "/manage_users");
                exit();
            }
        }
        Logger::logError("Lỗi ở method POST. Không có dữ liệu để khóa người dùng!");
        header("Location:" . _WEB_ROOT . "/manage_users");
        exit();
       
    }

    public function done()  {
        $this->render("admin/orders/daxuly", []);
    }

    public function canxuly()  {
        $this->render("admin/orders/qldh_canxuly", []);
    }

    public function khuyenmai()  {
        $this->render("admin/sales/sale", []);
    }

    public function taosp()  {
        $this->render("admin/products/Taosp", []);
    }

    public function qlsp()  {
        $this->render("admin/products/Quanlysanpham", []);
    }
}
?>

<?php if ($message = Helpers::getFlash('add_cart')): ?>
                  <div><?php echo $message; ?></div>
              <?php endif; ?>
            


              


           