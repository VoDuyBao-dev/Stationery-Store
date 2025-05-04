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
    private $manageProductTypeModel;
    private $manageProductModel;

    public function __construct()
    {
        try {
            $this->manageUserModel = $this->model('UserModel');
            $this->manageBrandModel = $this->model('BrandModel');
            $this->manageCategoryModel = $this->model('CategoryModel');
            $this->manageProductTypeModel = $this->model('ProductTypeModel');
            $this->manageProductModel = $this->model('ProductModel');

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
        $this->validateAdmin();
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
                Helpers::setFlash('notification', [
                    'type' => 'success',
                    'message' => 'Thêm sản phẩm mới thành công!'
                ]);

                header("Location:" . _WEB_ROOT . "/quan-ly-san-pham");
            } else {
                Helpers::setFlash('notification', [
                    'type' => 'error',
                    'message' => $result
                ]);

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
        $this->validateAdmin();
        if(isset($_GET['search_product'])) {
            $search = $_GET['search_product'];
            $productTypes = $this->manageProductTypeModel->getSearchProducts($search);
            $data = [
                "productTypes" => $productTypes
            ];
        } else {
            
            // phân trang
            $sd = 20;

            // Lấy số sp để phân trang

            $countProductTypes = $this->manageProductTypeModel->countProductType();
            // lấy tổng số sp
            $tsp = $countProductTypes['count'];
            // tính tổng số trang
            $tst = ceil($tsp / $sd);

            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else $page = 1;
            $vt = ($page - 1) * $sd; // vị trí bắt đầu

            // lấy số lượng sản phẩm tương ứng trên 1 trang

            $productTypes = $this->manageProductTypeModel->getAllProductType($vt, $sd);
            $data = [

                'tst' => $tst,
                'page' => $page,
                "productTypes" => $productTypes
            ];
        }
        
       

        

        $this->render("admin/products/Quanlysanpham", $data);
    }

    public function searchProduct()
    {
        $this->validateAdmin();
        if(isset($_GET['search'])) {
            $search = $_GET['search'];
            $productTypes = $this->manageProductTypeModel->searchProduct($search);
        } else {
            $productTypes = $this->manageProductTypeModel->getAllProductType();
        }
        // phân trang
        $sd = 20;

        // Lấy số sp để phân trang

        $countProductTypes = $this->manageProductTypeModel->countProductType();
        // lấy tổng số sp
        $tsp = $countProductTypes['count'];
        // tính tổng số trang
        $tst = ceil($tsp / $sd);

        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else $page = 1;
        $vt = ($page - 1) * $sd; // vị trí bắt đầu

        // lấy số lượng sản phẩm tương ứng trên 1 trang

        $productTypes = $this->manageProductTypeModel->getAllProductType($vt, $sd);


        $data = [

            'tst' => $tst,
            'page' => $page,
            "productTypes" => $productTypes
        ];

        $this->render("admin/products/Quanlysanpham", $data);
    }

    

    public function DeleteProduct()
    {
        $this->validateAdmin();
        if (isset($_GET['productType_id'])) {
            $productType_id = $_GET['productType_id'];
            $result = $this->manageProductTypeModel->deleteProductType($productType_id);
            if ($result) {
                Helpers::setFlash('message', 'Xóa sản phẩm thành công!');
            } else {
                Helpers::setFlash('error', 'Xóa sản phẩm thất bại!');
            }
        } else {
            Helpers::setFlash('error', 'ID sản phẩm không hợp lệ!');
        }

        header("Location:" . _WEB_ROOT . "/quan-ly-san-pham");
        exit();
    }

    public function editingProductPage()
    {
        $this->validateAdmin();
        $brands = $this->manageBrandModel->getAllBrand();
        $categories = $this->manageCategoryModel->getAllCategory();
        if (isset($_GET['product_id'])) {

            $product_id = $_GET['product_id'];

            // sản phẩm mặc định cần sửa
            $product = $this->manageProductModel->getProductID($product_id);
            
            $imagesProduct = $this->manageProductModel->getAll_imageOfProduct($product_id);
            $productType_ofProductID = $this->manageProductTypeModel->getAllProductType_ofProductID($product_id);



            if ($product) {
                $data = [
                    'brands' => $brands,
                    'categories' => $categories,
                    'product' => $product,
                    'imagesProduct' => $imagesProduct,
                    'productType_ofProductID' => $productType_ofProductID

                ];
                $this->render("admin/products/Suasanpham", $data);
            }
        }
    }

    public function editingProduct()
    {

        $this->validateAdmin();
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {

            $product_id = $_POST['product_id'] ?? null;
            if ($product_id === null || !is_numeric($product_id) || $product_id <= 0) {
                Helpers::setFlash('error', 'ID không hợp lệ!');
                header("Location:" . _WEB_ROOT . "/quan-ly-san-pham");
                exit();
            }


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
                    // Xử lý chuỗi giá tiền
                    $priceNew = $type['priceNew'] ?? '';
                    $priceCurrent = $type['priceCurrent'] ?? '';

                    // Loại bỏ ký tự đơn vị tiền và dấu chấm phân cách
                    $priceNew = str_replace(['₫', '.'], '', $priceNew);
                    $priceCurrent = str_replace(['₫', '.'], '', $priceCurrent);
                    
                    $productTypes[$key] = [
                        'name' => htmlspecialchars(trim(preg_replace('/\s+/', ' ', $type['productType_name']))),
                        'priceCurrent' => (float)$priceCurrent,
                        'priceNew' => !empty($priceNew) ? (float)$priceNew : null,
                        'stock_quantity' => intval($type['stock_quantity']),
                        'product_type_id' => $type['product_type_id']
                    ];
                    
                    // Validate giá
                    if ($productTypes[$key]['priceCurrent'] <= 0) {
                        $errors[] = "Giá bán phải lớn hơn 0";
                    }
                    if (!empty($productTypes[$key]['priceNew']) && 
                        $productTypes[$key]['priceNew'] > $productTypes[$key]['priceCurrent']) {
                        $errors[] = "Giá mới không được lớn hơn giá hiện tại";
                    }

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
                header("Location:" . _WEB_ROOT . "/sua-san-pham?product_id=$product_id");
                exit();
            }

            // Tất cả OK, gọi service để lưu
            $result = $this->productService->editingProduct($productData, $productTypes, $productImages, $product_id);

            if ($result === true) {
                Helpers::setFlash('message', "Cập nhật sản phẩm thành công!");
                header("Location:" . _WEB_ROOT . "/quan-ly-san-pham");
            } else {
                Helpers::setFlash('error', $result);
                header("Location:" . _WEB_ROOT . "/sua-san-pham?product_id=$product_id");
            }
            exit();
        }
    }
}
