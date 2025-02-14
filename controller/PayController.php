<?php
require_once 'model/Pay.php';

class PayController{
    public $pay;
    public function __construct(){
        $this->pay = new Pay();
    }

    public function placeOrder(){
        if (!isset($_SESSION['user'])) {
            header("Location: login.php");
            exit();
        }
        if(isset($_POST['place_order'])){

        $user = $_SESSION['user'];
        $cart_items = $_SESSION['cart_items'] ?? [];
        $total_amount = array_sum(array_column($cart_items, 'total_price'));
        $shipping_address = $user['user_address'] ?? 'No address';
        $phone = $user['user_phone'] ?? '';
                // Thêm đơn hàng vào bảng orders
                $order_id = $this->pay->createOrder($user['id'], $total_amount, $shipping_address, $phone);

                // Thêm sản phẩm vào bảng order_items
                $this->pay->addOrderItems($order_id, $cart_items);
        
                // Xóa giỏ hàng sau khi đặt hàng thành công
                unset($_SESSION['cart_items']);
                header("Location: ?act=viewcart");
        }
    }
}