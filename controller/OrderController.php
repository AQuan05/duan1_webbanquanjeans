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
        $status = isset($_GET['status']) ? $_GET['status'] : ""; // Lấy trạng thái từ URL
        $orders = $this->order->getOrdersByUserAndStatus($user_id, $status);
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
        if (isset($_POST['cancel']) && isset($_POST['order_id']) ) {
            $order_id = $_POST['order_id'];
            $user_id = $_POST['user_id'];
            // Kiểm tra nếu order_id hợp lệ
            if ($order_id <= 0) {
                echo "<script>alert('Vui lòng cung cấp order_id hợp lệ.'); window.history.back();</script>";
                return;
            }

            // Gọi phương thức cancelOrder từ model để hủy đơn
            $result = $this->order->cancelOrder($order_id);

            // Kiểm tra kết quả
            if ($result) {
                // Hủy đơn hàng thành công, chuyển hướng về trang danh sách đơn hàng
                echo "<script>alert('Hủy đơn hàng thành công.'); window.location.href = '?act=listOrder&user_id=$user_id';</script>";
                exit();
            } else {
                // Nếu có lỗi khi hủy đơn
                echo "<script>alert('Có lỗi xảy ra trong quá trình hủy đơn hàng.'); window.history.back();</script>";
            }
        } else {
            // Nếu không có POST request, chuyển hướng về trang đơn hàng
            echo '<script>alert("Vui lòng cung cấp order_id hợp lệ."); window.history.back();</script>';
            exit();
        }
    }
}
