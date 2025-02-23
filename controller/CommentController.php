<?php

require_once 'model/Comment.php';

class CommentController
{
    private $commentModel;

    public function __construct()
    {
        $this->commentModel = new Comment();
    }

    // Xử lý thêm đánh giá từ form
    public function store()
{
    if (isset($_POST['content'])) {
        $user_id = $_POST['user_id'] ?? $_SESSION['user']['user_id'] ?? null;
        $order_id = $_POST['order_id'];
        $product_id = $_POST['product_id'];
        $content = $_POST['content'];

        if (!$user_id) {
            die("User ID not found!");
        }

        // Kiểm tra đơn hàng đã hoàn thành chưa
        if ($this->commentModel->isOrderCompleted($order_id, $user_id)) {
            // Kiểm tra sản phẩm trong đơn này đã được đánh giá chưa
            if (!$this->commentModel->hasCommented($order_id, $product_id, $user_id)) {
                if ($this->commentModel->addComment($order_id, $product_id, $user_id, $content)) {
                    header("Location: index.php?act=orderDetail&order_id=$order_id&success=1");
                    exit();
                } else {
                    header("Location: index.php?act=orderDetail&order_id=$order_id&error=1");
                    exit();
                }
            } else {
                header("Location: index.php?act=orderDetail&order_id=$order_id&error=2"); // Sản phẩm này đã được đánh giá trong đơn này
                exit();
            }
        } else {
            header("Location: index.php?act=orderDetail&order_id=$order_id&error=3"); // Đơn chưa hoàn thành
            exit();
        }
    }
}

}
