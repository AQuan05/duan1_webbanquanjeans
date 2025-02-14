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
            $cart = $this->cartModel->getCartByUserId($user['user_id']);
            $cart_items = $this->cartModel->getCartItems($cart['cart_id']);
            $total_amount = array_sum(array_map(function ($item) {
                return $item['price'] * $item['quantity'];
            }, $cart_items));

            $shipping_address = $_POST['address'] ?? 'No address';
            $phone = $_POST['phonenumber'] ?? '0000000000';
            $order_id = $this->pay->createOrderWithItems($user['user_id'], $total_amount, $shipping_address, $phone, $cart_items);
            // if($order_id) {
            //     $this->pay->deleteCart($cart['cart_id']);
            // }
            header("Location: ?act=shop");
        }
    }
}