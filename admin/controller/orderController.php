<?php
require_once '../admin/model/Order.php';
class orderController
{
    public $Order;
    public function __construct()
    {
        $this->Order = new Order();
    }
    public function listOrders()
    {
        $orders = $this->Order->getOrdersWithUsernames();
        include '../admin/view/pagines/order/listOder.php';
    }
    public function orderDetails()
    {
        if (isset($_GET['order_id'])) {
            $order_id = intval($_GET['order_id']);
            
            // Lấy chi tiết đơn hàng
           $orderDetails = $this->Order->getOrderDetails($order_id);
            // Lấy danh sách trạng thái từ bảng status
            $statuses = $this->Order->getAllStatuses();

            if ($orderDetails && $statuses) {
                include '../admin/view/pagines/order/detailOrder.php';
            } else {
                echo "Không tìm thấy chi tiết đơn hàng hoặc trạng thái!";
            }
        } else {
            echo "Thiếu order_id!";
        }
    }
    public function updateOrderStatus($order_id, $status_id)
    {
        if (isset($_POST['updateOrder']) && isset($_POST['order_id']) && isset($_POST['status_id'])) {
            $order_id = intval($_POST['order_id']);
            $status_id = intval($_POST['status_id']);
            $this->Order->updateOrderStatus($order_id, $status_id);
            header('Location: ?act=listOrders');
        } else {
            echo "Thiếu order_id hoặc status_id!";
        }
    }
}
