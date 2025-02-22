<?php

require_once 'model/Order.php';

class OrderController
{
    public $order;
    public function __construct()
    {
        $this->order = new Order();
    }
    public function listOrdersByUser($user_id)
    {
        $orders = $this->order->getOrderByUserId($user_id);
        require_once 'view/pagines/order/listOrder.php';
    }
    public function orderDetails($order_id)
    {
        $order = $this->order->getOrderById($order_id);
        $orderItems = $this->order->getOrderItemsByOrderId($order_id);
        require_once 'view/pagines/order/orderDetails.php';
    }
    public function index()
    {
        $status = isset($_GET['status']) ? $_GET['status'] : "";
        $orders = $this->order->getAllOrders($status);
        require_once 'view/pagines/order/listOrder.php';
    }
    public function cancelOrder()
    {
        // Kiểm tra xem dữ liệu có được gửi lên không
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
            $order_id = $_POST['order_id'];

            // Khởi tạo đối tượng Order// Giả sử $this->db là đối tượng PDO đã được khởi tạo

            // Gọi phương thức hủy đơn
            $result = $this->order->cancelOrder($order_id);

            if ($result) {
                // Nếu hủy thành công, chuyển hướng đến trang đơn hàng hoặc trang thông báo thành công
                echo "<script>alert('Đơn hàng đã được hủy thành công.'); window.location.href = 'orders.php';</script>";
            } else {
                // Nếu có lỗi khi hủy đơn
                echo "<script>alert('Có lỗi xảy ra trong quá trình hủy đơn hàng.'); window.history.back();</script>";
            }
        } else {
            // Nếu không có POST request, chuyển hướng về trang đơn hàng
            header("Location: ?act=listOrders");
        }
    }
}
