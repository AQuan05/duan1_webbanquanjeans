<?php
require_once 'model/Pay.php';
require_once 'model/Cart.php';

class PayController
{
    public $pay;
    public $cartModel;
    
    public function __construct()
    {
        $this->pay = new Pay();
        $this->cartModel = new Cart();
    }

    public function placeOrder()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: login.php");
            exit();
        }

        if (isset($_POST['place_order'])) {
            $user = $_SESSION['user'] ?? null;
            $cart_items = $_SESSION['cart_items'] ?? [];
            $cart = $this->cartModel->getCartByUserId($user['user_id']);
            $cart_items = $this->cartModel->getCartItems($cart['cart_id']);
            $total_amount = array_sum(array_map(function ($item) {
                return $item['price'] * $item['quantity'];
            }, $cart_items));

            $shipping_address = $_POST['address'] ?? 'No address';
            $phone = $_POST['phonenumber'] ?? '0000000000';

            // Thêm đơn hàng vào bảng orders
            $order_id = $this->pay->createOrder($user['user_id'], $total_amount, $shipping_address, $phone);

            // Kiểm tra nếu có sản phẩm thì thêm vào order_items
            $this->pay->addOrderItems($order_id, $cart_items);

            // Xóa giỏ hàng sau khi đặt hàng thành công
            unset($_SESSION['cart_items']);
            header("Location: ?act=viewcart");
        }
    }
    
}
