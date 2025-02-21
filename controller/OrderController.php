<?php

require_once 'model/Order.php';

class OrderController{
    public $order;
    public function __construct()
    {
        $this->order = new Order();
    }
    public function listOrdersByUser($user_id) {
        $orders = $this->order->getOrderByUserId($user_id);
        require_once 'view/pagines/order/listOrder.php';
    }
    public function orderDetails($order_id) {
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
}