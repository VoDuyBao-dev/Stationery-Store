<?php
    class Chat extends Controller{

        private $chatModel;
        // public function __construct()
        // {
        //     try {
        //         $this->chatModel = $this->model('ChatModel');
    
        //         if (!$this->chatModel) {
        //             throw new Exception("Lỗi trong quá trình tạo đối tượng");
        //         }
        //     } catch (Exception $e) {
        //         header("Location:" . _BASE_URL . "/app/errors/loichung.php?message=" . urlencode($e->getMessage()));
        //         exit;
        //     }
    
        // }
        public function index(){
            $this->render("mess/chat");
        }


        public function detail(){
            $this->render("mess/chatmot");
        }
    }
?>