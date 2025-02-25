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
        // Kiểm tra đầu vào hợp lệ
        if (!isset($order_id) || !isset($status_id)) {
            echo "Thiếu order_id hoặc status_id!";
            return;
        }
        $order_id = intval($order_id);
        $status_id = intval($status_id);

        // Lấy trạng thái hiện tại của đơn hàng
        $current_status = $this->Order->getOrderStatus($order_id);

        // Nếu trạng thái không thay đổi, quay lại trang danh sách đơn hàng
        if ($current_status == $status_id) {
            header('Location: ?act=listOrders');
            exit();
        }

        // Cập nhật trạng thái nếu có sự thay đổi
        $result = $this->Order->updateOrderStatus($order_id, $status_id);

        if ($result) {
            header('Location: ?act=listOrders');
            exit();
        } else {
            echo "Cập nhật trạng thái thất bại!";
        }
    }
    public function sumOrdersStatusSuccessController() {
        $sumStatusSucces = $this->Order->sumOrdersStatusSuccess();
        $orderToday = $this->Order->orderToady();

    
        $revenueData = $this->Order->getRevenueByDate();
        $dates = $revenueData['dates'] ?? [];
        $revenues = $revenueData['revenues'] ?? [];
        $statusRatio = $this->Order->getOrderStatusRatio();
        $canceled = $statusRatio['canceled'] ?? 0;
        $successful = $statusRatio['successful'] ?? 0;
        if ($sumStatusSucces !== false && $orderToday !== false) {
            $data = [
                'sumStatusSucces' => $sumStatusSucces,
                'orderToday' => $orderToday,
        
                'dates' => json_encode($dates),
                'revenues' => json_encode($revenues),
                'canceled' => $canceled,
                'successful' => $successful
            ];
            // var_dump($data); die;
            require_once '../admin/view/layout/home.php';
        } elseif ($sumStatusSucces !== false) {
            echo "Chỉ có dữ liệu tổng đơn hàng thành công.";
        } elseif ($orderToday !== false) {
            echo "Chỉ có dữ liệu đơn hàng hôm nay.";
        } else {
            echo "Không thể lấy dữ liệu.";
        }
    }
}
