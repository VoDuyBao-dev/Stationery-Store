<?php

class App
{
    private $__controller, $__action, $__params, $__routes;

    function __construct()
    {
        global $routes, $config;

        $this->__routes = new Route();
//        Kiểm tra biến biến routes có tồn tại không
        if (!empty($routes['default_controller'])) {
            $this->__controller = $routes['default_controller'];
        }

        $this->__action = 'index';
        $this->__params = [];
        $this->handleUrl();
    }

    public function getUrl()
    {
        if (!empty($_SERVER['PATH_INFO'])) {
            $url = $_SERVER['PATH_INFO'];
        } else {
            $url = '/';
        }
        return $url;
    }

//quy ước url: vd: home/index/a/b/c
//-> home: Tên controller tương ứng
//-> index: tên phương thức hay còn gọi là action
//-> a/b/c: là các tham số
//    Tách url:

    public function handleUrl()
    {
        $url = $this->getUrl();

//        xử lý route
        $url = $this->__routes->handRoute($url);


//        Tách url thành dạng mảng theo dấu '/'
//      array_filter  sẽ loại bỏ các phần tử rỗng trong mảng.
        $urlArr = array_filter(explode('/', $url));
//        Đưa array về đúng định dạng bắt đầu từ chỉ số 0
        $urlArr = array_values($urlArr);
//        Xử lý controller
        if (!empty($urlArr[0])) {
//            class viết in hoa chữ đầu nên dùng ucfirst để viết hoa chữ đầu phù hợp với controller tương ứng
            $this->__controller = ucfirst($urlArr[0]);
        } else {
//            Xử lý trường hợp không nhập gì trên đường dẫn
            $this->__controller = ucfirst($this->__controller);

        }

        //            require_once đến file controller tương ứng
//            vd: home/index/a/b/c/d -> khi qua ucfirst sẽ thành Home
//            qua đó truy cập vô file Home.php bên trong dictionery controller
//            Trươc khi require_once phải kiểm tra có tồn tại không
//            chú ý phải kiểm tra đường dẫn từ root: thêm app/
        if (file_exists("app/controllers/$this->__controller.php")) {
            require_once "controllers/$this->__controller.php";
//            Kiểm tra class this->__controller có tồn tại không
            if (class_exists($this->__controller)) {
                //                nếu như controller có tồn tại thì khởi tạo 1 object của đối tượng đó
                $this->__controller = new $this->__controller();
                unset($urlArr[0]);
            } else {
                $this->loadError();
            }


        } else $this->loadError();

//        Xử lý acction
        if (!empty($urlArr[1])) {
//            Lay action tu url
//            Nếu không có $urlArr[1] thì mặc định là index vì khai báo trên construct
            $this->__action = $urlArr[1];
            unset($urlArr[1]);
        }
//        Xử lý param: unset $urlArr[0] và $urlArr[1] để còn lại các params
//        Đưa mảng các params về đúng định dạng:
        $this->__params = array_values($urlArr);
        
//        Kiểm tra xem method trong controller có tồn tại không thì mới gọi func
        if (method_exists($this->__controller, $this->__action)) {

            //        call_user_func_array() là một hàm có sẵn trong PHP, dùng để gọi một phương thức hoặc hàm
//  và truyền các tham số cho nó dưới dạng mảng.
//        http://localhost/home/index/123/456/789
//        $controller = new Home(); // Khởi tạo đối tượng HomeController
//$controller->index([123, 456, 789]); // Gọi phương thức index với tham số 123, 456, 789
            call_user_func_array([$this->__controller, $this->__action], [$this->__params]);

        } else {
            $this->loadError();
        }


    }

    public function loadError($name = '404')
    {
        require_once "errors/$name.php";

    }


}