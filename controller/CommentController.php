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
            // Kiểm tra nếu user_id được truyền qua URL hoặc từ session
            if (isset($_GET['user_id'])) {
                $user_id = $_GET['user_id'];
            } elseif (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
            } else {
                // Xử lý nếu không có user_id
                die("User not logged in");
            }

            $order_id = $_POST['order_id'];
            $product_id = $_POST['product_id'];
            $user_id = $_POST['user_id'];
            $content = $_POST['content'];
            $rating = $_POST['rating'];

            // Kiểm tra nếu đơn hàng đã hoàn thành và chưa có đánh giá
            if ($this->commentModel->isOrderCompleted($order_id, $user_id) && !$this->commentModel->hasCommented($order_id, $product_id, $user_id)) {
                if ($this->commentModel->addComment($order_id, $product_id, $user_id, $content, $rating)) {
                    header("Location: index.php?act=orderDetail&order_id=$order_id&success=1");
                    exit();
                } else {
                    header("Location: index.php?act=orderDetail&order_id=$order_id&error=1");
                    exit();
                }
            } else {
                header("Location: index.php?act=orderDetail&order_id=$order_id&error=2"); // Không hợp lệ
                exit();
            }
        }
    }
}
