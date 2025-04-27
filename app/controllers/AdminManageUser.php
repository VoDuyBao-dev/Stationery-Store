<?php

use App\Helpers\ImageUploadHelper;
use core\Helpers;
use App\Logger;

class AdminManage extends Controller
{
    private $manageUserModel;
    private $manageCategoryModel;
    private $manageBrandModel;
    private $productService;

    public function __construct()
    {
        try {
            $this->manageUserModel = $this->model('UserModel');
            $this->manageBrandModel = $this->model('BrandModel');
            $this->manageCategoryModel = $this->model('CategoryModel');
            $this->productService = new ProductService();

            if (!$this->manageUserModel) {
                throw new Exception("Lỗi trong quá trình tạo đối tượng");
            }
        } catch (Exception $e) {
            header("Location:" . _WEB_ROOT . "/app/errors/loichung.php?message=" . urlencode($e->getMessage()));
            exit;
        }
    }


    public function listuser()
    {
        $this->validateAdmin();
        $users = $this->manageUserModel->getAllUsers();
        $usersLock = $this->manageUserModel->getAllUsersLock();
        $data = [
            "users" => $users,
            "usersLock" => $usersLock
        ];
        $this->render("admin/customers/Taikhoan", $data);
    }


    public function unlockUser()
    {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if ($id === null || !is_numeric($id) || $id <= 0) {
                Helpers::setFlash('error', 'ID không hợp lệ!');
                header("Location:" . _WEB_ROOT . "/manage_users");
                exit();
            }
            $id = (int)$id;

            $user = $this->manageUserModel->getUserById($id);
            if ($user === false) {
                Helpers::setFlash('error', 'Không tìm thấy người dùng cần mở khóa!');

                header("Location:" . _WEB_ROOT . "/manage_users");
                exit();
            }
            $result = $this->manageUserModel->unlockUser($id);
            if ($result) {
                Helpers::setFlash('message', 'Mở khóa người dùng thành công!');

                header("Location:" . _WEB_ROOT . "/manage_users");
                exit();
            } else {
                Helpers::setFlash('error', 'Mở khóa người dùng thất bại!');

                header("Location:" . _WEB_ROOT . "/manage_users");
                exit();
            }
        }
        Logger::logError("Lỗi ở method POST. Không có dữ liệu để mở khóa người dùng!");
        header("Location:" . _WEB_ROOT . "/manage_users");
        exit();
    }


    public function lockUser()
    {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if ($id === null || !is_numeric($id) || $id <= 0) {
                $_SESSION['error'] = "ID không hợp lệ!";
                header("Location:" . _WEB_ROOT . "/manage_users");
                exit();
            }
            $id = (int)$id;

            $user = $this->manageUserModel->getUserById($id);
            if ($user === false) {
                $_SESSION['error'] = "Không tìm thấy người dùng cần khóa!";
                header("Location:" . _WEB_ROOT . "/manage_users");
                exit();
            }
            $result = $this->manageUserModel->lockUser($id);
            if ($result) {
                $_SESSION['message'] = "Khóa người dùng thành công!";
                header("Location:" . _WEB_ROOT . "/manage_users");
                exit();
            } else {
                $_SESSION['error'] = "Khóa người dùng thất bại!";
                header("Location:" . _WEB_ROOT . "/manage_users");
                exit();
            }
        }
        Logger::logError("Lỗi ở method POST. Không có dữ liệu để khóa người dùng!");
        header("Location:" . _WEB_ROOT . "/manage_users");
        exit();
    }

    // Quản lý sp

    public function addProduct()
    {
        $brands = $this->manageBrandModel->getAllBrand();
        $categories = $this->manageCategoryModel->getAllCategory();

        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];

            // Xử lý và kiểm tra dữ liệu sản phẩm cơ bản
            $productData = [
                'name' => htmlspecialchars(trim(preg_replace('/\s+/', ' ', $_POST['product_name']))) ?? null,
                'description' => htmlspecialchars(trim(preg_replace('/\s+/', ' ', $_POST['description']))) ?? null,
                'category_id' => $_POST['category_id'] ?? null,
                'brand_id' => $_POST['brand_id'] ?? null
            ];

            // Kiểm tra dữ liệu bắt buộc
            if (!$productData['name'] || !$productData['category_id'] || !$productData['brand_id']) {
                Helpers::setFlash('error', 'Vui lòng điền đầy đủ thông tin!');
                header("Location:" . _WEB_ROOT . "/them-san-pham");
                exit();
            }

            // Xử lý product types
            $productTypes = [];
            if (isset($_POST['product_types']) && is_array($_POST['product_types'])) {
                foreach ($_POST['product_types'] as $key => $type) {
                    $productTypes[$key] = [
                        'name' => htmlspecialchars(trim(preg_replace('/\s+/', ' ', $type['name']))),
                        'priceCurrent' => $type['priceCurrent'],
                        'stock_quantity' => $type['stock_quantity']
                    ];

                    // Xử lý ảnh chính của product type
                    if (isset($_FILES['product_types']['name'][$key]['main_image'])) {
                        $file = [
                            'name' => $_FILES['product_types']['name'][$key]['main_image'],
                            'type' => $_FILES['product_types']['type'][$key]['main_image'],
                            'tmp_name' => $_FILES['product_types']['tmp_name'][$key]['main_image'],
                            'error' => $_FILES['product_types']['error'][$key]['main_image'],
                            'size' => $_FILES['product_types']['size'][$key]['main_image']
                        ];


                        $ketQuaUpload = ImageUploadHelper::kiemTraVaUploadAnh(
                            $file,
                            "public/assets/clients/images/image_products_type/all_image_upload/"
                        );

                        if (!$ketQuaUpload['thanhCong']) {
                            $errors[] = "Lỗi upload ảnh cho phân loại '{$type['name']}': " . $ketQuaUpload['loiNhan'];
                            Logger::logError("Lỗi upload ảnh phân loại: " . $ketQuaUpload['loiNhan']);
                            continue;
                        }

                        $productTypes[$key]['image'] = $ketQuaUpload['duongDan'];
                    }
                }
            }

            // Xử lý ảnh phụ sản phẩm
            $productImages = [];
            if (isset($_FILES['product_images'])) {
                foreach ($_FILES['product_images']['tmp_name'] as $key => $tmp_name) {
                    if ($_FILES['product_images']['error'][$key] === UPLOAD_ERR_OK) {
                        $file = [
                            'name' => $_FILES['product_images']['name'][$key],
                            'type' => $_FILES['product_images']['type'][$key],
                            'tmp_name' => $tmp_name,
                            'error' => $_FILES['product_images']['error'][$key],
                            'size' => $_FILES['product_images']['size'][$key]
                        ];

                        $ketQuaUpload = ImageUploadHelper::kiemTraVaUploadAnh(
                            $file,
                            "public/assets/clients/images/image_product/all_image_upload/"
                        );

                        if (!$ketQuaUpload['thanhCong']) {
                            $errors[] = "Lỗi upload ảnh phụ: " . $ketQuaUpload['loiNhan'];
                            continue;
                        }

                        $productImages[] = [
                            'path' => $ketQuaUpload['duongDan']
                        ];
                    }
                }
            }

            // Kiểm tra lỗi trước khi lưu
            if (!empty($errors)) {
                Helpers::setFlash('error', implode("<br>", $errors));
                header("Location:" . _WEB_ROOT . "/them-san-pham");
                exit();
            }

            // Tất cả OK, gọi service để lưu
            $result = $this->productService->createNewProduct(
                $productData,
                $productTypes,
                $productImages
            );

            if ($result === true) {
                Helpers::setFlash('message', "Thêm sản phẩm mới thành công!");
                header("Location:" . _WEB_ROOT . "/quan-ly-san-pham");
            } else {
                Helpers::setFlash('error', $result);
                header("Location:" . _WEB_ROOT . "/them-san-pham");
            }
            exit();
        }

        // Render form
        $this->render('admin/products/Taosp', [
            'brands' => $brands,
            'categories' => $categories
        ]);
    }

    public function qlsp()
    {
        $this->render("admin/products/Quanlysanpham", []);
    }
}
