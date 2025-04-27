<?php

class Review {
    private $reviewModel;

    public function __construct()
    {
        try {
            $this->ReviewModel = $this->model('ReviewModel');  // tạo một object mới

            if (!$this->chatModel) {
                throw new Exception("Lỗi trong quá trình tạo đối tượng");
            }
        } catch (Exception $e) {
            header("Location:" . _BASE_URL . "/app/errors/loichung.php?message=" . urlencode($e->getMessage()));
            exit;
        }
    }

    // Hiển thị review của sản phẩm
    public function showReviews($product_id) {
        $reviews = $this->reviewModel->getReviewsByProductId($product_id);
        include 'views/review_view.php'; // view hiển thị review
    }

    // Xử lý thêm review mới
    public function addReview() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product_id = $_POST['product_id'];
            $user_id = $_POST['user_id']; // hoặc lấy từ session nếu có login
            $comment = trim($_POST['comment']);
            $rating = (int) $_POST['rating'];

            if (!empty($comment) && $rating > 0 && $rating <= 5) {
                $this->reviewModel->insertReview($product_id, $user_id, $comment, $rating);
                header("Location: index.php?controller=review&action=showReviews&product_id=$product_id");
            } else {
                echo "Dữ liệu không hợp lệ!";
            }
        }
    }
}
?>
