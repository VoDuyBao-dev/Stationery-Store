<?php

class ReviewModel {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    // Lấy danh sách review theo product_id
    public function getReviewsByProductId($product_id) {
        $stmt = $this->conn->prepare("SELECT * FROM reviews WHERE product_id = ?");
        $stmt->execute([$product_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Thêm review mới
    public function insertReview($product_id, $user_id, $comment, $rating) {
        $stmt = $this->conn->prepare("INSERT INTO reviews (product_id, user_id, comment, rating, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())");
        return $stmt->execute([$product_id, $user_id, $comment, $rating]);
    }
}
?>
