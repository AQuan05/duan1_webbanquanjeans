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
}