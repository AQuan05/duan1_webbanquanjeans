<?php
require_once 'model/config_vnpay.php';
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
        if(isset($_POST['pttt']) && $_POST['pttt'] == "tt"){
            if (isset($_POST['place_order'])) {
                $user = $_SESSION['user'] ?? null;
                $cart = $this->cartModel->getCartByUserId($user['user_id']);
                $cart_items = $this->cartModel->getCartItems($cart['cart_id']);
                $total_amount = array_sum(array_map(function ($item) {
                    return $item['price'] * $item['quantity'];
                }, $cart_items));
    
                $shipping_address = $_POST['address'] ?? 'No address';
                $phone = $_POST['phonenumber'] ?? '0000000000';
                $pttt = "tructiep";
                $order_id = $this->pay->createOrderWithItems($user['user_id'], $total_amount, $shipping_address, $phone,$pttt, $cart_items);
                if($order_id) {
                    $this->pay->deleteCart($cart['cart_id']);
                }
                header("Location: ?act=shop");
            }
        }elseif(isset($_POST['pttt']) && $_POST['pttt'] == "vnpay"){
            if (isset($_POST['place_order'])) {
                $user = $_SESSION['user'] ?? null;
                $cart = $this->cartModel->getCartByUserId($user['user_id']);
                $cart_items = $this->cartModel->getCartItems($cart['cart_id']);
                $total_amount = array_sum(array_map(function ($item) {
                    return $item['price'] * $item['quantity'];
                }, $cart_items));
    
                $shipping_address = $_POST['address'] ?? 'No address';
                $phone = $_POST['phonenumber'] ?? '0000000000';
                $pttt = "vnpay";
                $order_id = $this->pay->createOrderWithItems($user['user_id'], $total_amount, $shipping_address, $phone,$pttt, $cart_items);
                if($order_id) {
                    $this->pay->deleteCart($cart['cart_id']);
                }
                $total_amount = array_sum(array_map(function ($item) {
                    return $item['price'] * $item['quantity'];
                }, $cart_items));
                echo $total_amount;
                error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
                $vnp_Returnurl = "http://localhost/duan1_webbanquanjeans/?act=success";
                $vnp_TmnCode = "WG6RCT6R"; 
                $vnp_HashSecret = "EMNBSNLHGWLGFOQXDXZZQGNONOSETZZF";
                $startTime = date("YmdHis");
                $expire = date('YmdHis', strtotime('+5 minutes', strtotime($startTime)));
                $vnp_TxnRef = time() . ''; 
                $vnp_OrderInfo = 'hahah';
                $vnp_OrderType = 'noi dung thanh toan';
                $vnp_Amount = $total_amount * 100;
                $vnp_Locale = 'vn';
                $vnp_BankCode = 'NCB';
                $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
                $vnp_ExpireDate = $expire;

                $inputData = array(
                    "vnp_Version" => "2.1.0",
                    "vnp_TmnCode" => $vnp_TmnCode,
                    "vnp_Amount" => $vnp_Amount,
                    "vnp_Command" => "pay",
                    "vnp_CreateDate" => date('YmdHis'),
                    "vnp_CurrCode" => "VND",
                    "vnp_IpAddr" => $vnp_IpAddr,
                    "vnp_Locale" => $vnp_Locale,
                    "vnp_OrderInfo" => $vnp_OrderInfo,
                    "vnp_OrderType" => $vnp_OrderType,
                    "vnp_ReturnUrl" => $vnp_Returnurl,
                    "vnp_TxnRef" => $vnp_TxnRef,
                    "vnp_ExpireDate" => $vnp_ExpireDate,
                );

                if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                    $inputData['vnp_BankCode'] = $vnp_BankCode;
                }
                ksort($inputData);
                $query = "";
                $i = 0;
                $hashdata = "";
                foreach ($inputData as $key => $value) {
                    if ($i == 1) {
                        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                    } else {
                        $hashdata .= urlencode($key) . "=" . urlencode($value);
                        $i = 1;
                    }
                    $query .= urlencode($key) . "=" . urlencode($value) . '&';
                }

                $vnp_Url = $vnp_Url . "?" . $query;
                if (isset($vnp_HashSecret)) {
                    $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
                    $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
                }
                $returnData = array(
                    'code' => '00', 'message' => 'success', 'data' => $vnp_Url
                );
                header('Location: ' . $vnp_Url);
                die();
                
            }
        }
    }
}