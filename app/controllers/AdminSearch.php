<?php

class AdminSearch extends Controller
{
    private $searchModel;
    public function __construct()
    {
        try {
            $this->searchModel = $this->model('AdminSearchModel');  // tạo một object mới

            if (!$this->searchModel) {
                throw new Exception("Lỗi trong quá trình tạo đối tượng");
            }
        } catch (Exception $e) {
            header("Location:" . _BASE_URL . "/app/errors/loichung.php?message=" . urlencode($e->getMessage()));
            exit;
        }
    }


    public function index()
    {
        // echo "đen dược đây";
        // die();
        $keyword = $_GET['q'] ?? '';
        // $searchModel = $this->model('AdminSearchModel');
        $results = $this->searchModel->search($keyword);

        $this->render('admin/admin_search', [
            'keyword' => $keyword,
            'results' => $results
        ]);
    }
}
?>
