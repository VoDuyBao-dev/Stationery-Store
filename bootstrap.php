<?php
// đường dẫn đến dự án
define('_DIR_ROOT', __DIR__);


// Đường dẫn BASE URL
define('_BASE_URL', 'http://localhost/Stationery-Store');

// XỬ LÝ HTTP ROOT
// vd: ở đường link css ở file client_layout:
// "http://localhost/Stationery-Store/public/assets/clients/css/style.css"
// => http root: http://localhost/Stationery-Store
if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
    $web_root = 'http://' . $_SERVER['HTTP_HOST'];
} else {
    $web_root = 'http://' . $_SERVER['HTTP_HOST'];
}

// Xử lý để lấy chuỗi '/Stationery-Store'
$folder = str_replace(strtolower($_SERVER['DOCUMENT_ROOT']), '', str_replace('\\', '/', strtolower(_DIR_ROOT)));

// Lấy tên folder dự án
$name_folder = str_replace("/", "", $folder);
define('_NAME_PROJECT', $name_folder);

$web_root = $web_root . $folder;
define('_WEB_ROOT', $web_root);



// Tự đông load configs
// $configs_dir = scandir('configs');
// //check xem dir configs có khác rỗng không
// if (!empty($configs_dir)) {
//     foreach ($configs_dir as $file_configs) {
//         if ($file_configs != '.' && $file_configs != '..' && file_exists('configs/' . $file_configs)) {
//             require_once('configs/' . $file_configs);
//         }
//     }
// }
require_once "app/Logger.php"; //Load Log
require_once "core/Helpers.php";
require_once "configs/routes.php"; // Load routes config
require_once "configs/database.php";

require_once "core/Route.php"; //Load Route class

require_once "core/Mail.php"; //Load Mail

require_once "core/OtpService.php"; //Load OtpService
require_once "app/App.php"; //Load App
require_once __DIR__ . "/core/Connection.php";


//Kiểm tra config và load Database
if (!empty($config['database'])) {
    $db_config = array_filter($config['database']);

    if (!empty($db_config)) {
        require_once 'core/Connection.php';
        require_once 'core/Database.php';
    }
}

// Load api google
require_once "app/libraries/google-api-php-client/vendor/autoload.php";
// load vendor autoload của các packet tải bằng composer
require 'vendor/autoload.php';

// Load database xong mới tới load model
require_once "core/Model.php"; //Load base Model
require_once "core/Controller.php"; //Load base controller

// load file config của google
require_once "configs/google_client.php";

// Load all Service
require_once "app/services/OrderService.php";
require_once "app/services/CouponService.php";
require_once "app/services/VNPayPaymentProcessing.php";
require_once "app/services/MomoPaymentProcessing.php";
// load google service
require_once "app/services/GoogleAuthService.php";

// admin quan lý hàng
require_once "app/services/ProductService.php";
