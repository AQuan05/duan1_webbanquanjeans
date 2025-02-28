<?php
require_once 'model/Cart.php';
require_once 'model/shopModel.php';
class cartController
{
    private $cartModel;
    private $shopModel;
    public function __construct()
    {
        $this->cartModel = new Cart();
        $this->shopModel = new shopModel();
    }
    public function viewcart()
    {
        $user_id = null; // Định nghĩa biến mặc định để tránh lỗi Undefined variable

        if (isset($_SESSION['user']) && isset($_SESSION['user']['user_id'])) {
            $user_id = $_SESSION['user']['user_id'];

            // Lấy cart_id của user từ database
            $cart = $this->cartModel->getCartByUserId($user_id);
            if ($cart) {
                $cart_id = $cart['cart_id'];
            } else {
                $_SESSION['error'] = "Không tìm thấy giỏ hàng của bạn.";
                header('Location: ?act=/');
                exit();
            }
        } else {
            // Nếu chưa đăng nhập, sử dụng giỏ hàng tạm thời (cart_id = 0)
            $cart_id = 0;
        }

        // Nếu user chưa đăng nhập, không gọi listCart để tránh lỗi
        if ($user_id) {
            $cartItems = $this->cartModel->listCart($user_id);
        } else {
            $cartItems = [];
        }

        include "view/pagines/cart/viewcart.php";
    }

    public function addToCart()
    {
        if (isset($_POST['add_to_cart'])) {
            if (!isset($_SESSION['user'])) {
                $_SESSION['error'] = "Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng.";
                header('Location: ?act=login');
                exit();
            }

            $user_id = $_SESSION['user']['user_id'];

            // Lấy cart_id của user từ database
            $cart = $this->cartModel->getCartByUserId($user_id);
            if (!$cart) {
                $_SESSION['error'] = "Không tìm thấy giỏ hàng.";
                header('Location: ?act=viewcart');
                exit(); 
            }
            $product_id = $this->shopModel->getProductById($_POST['product_id']);
            // var_dump($product_id);
            // die();   
            if (!$product_id) {
                $_SESSION['error'] = "Sản phẩm không tồn tại.";
                header('Location: ?act=viewcart');
                exit();
            }

            $cart_id = $cart['cart_id']; // Lấy cart_id của user từ database
            $cartItems = $this->cartModel->getCartItemsByUserId($user_id);

            $product_id  = (int) $_POST['product_id'];
            $quantity    = (int) $_POST['quantity'];
            $price       = (float) $_POST['price'];
            $total_price = $price * $quantity;

            // Gọi model để thêm sản phẩm vào giỏ hàng
            $this->cartModel->addToCart($cart_id, $product_id, $quantity, $price, $total_price);

            header("Location: ?act=viewcart");
            exit();
        }
    }
    
    public function updateCartQuantity()
    {
        if (isset($_POST['cart_item_id']) && isset($_POST['quantity']) && isset($_POST['update_qty'])) {
            $cart_item_id = $_POST['cart_item_id'];
            $quantity     = (int) $_POST['quantity'];
            $change       = (int) $_POST['update_qty'];  // +1 hoặc -1
            $newQuantity  = max(1, min(10, $quantity + $change)); // Không cho < 1

            // Cập nhật Database
            $this->cartModel->updateCartItemQuantity($cart_item_id, $newQuantity);

            // Cập nhật SESSION
            foreach ($_SESSION['cart'] as &$item) {
                if ($item['cart_item_id'] == $cart_item_id) {
                    $item['quantity']    = $newQuantity;
                    $item['total_price'] = $item['price'] * $newQuantity; // ✅ Cập nhật lại total_price
                    break;
                }
            }
            header("Location: ?act=viewcart");
            exit();
        }
    }
        public function viewCheckout()
    {
        if (!isset($_SESSION['user'])) {
            $_SESSION['error'] = "Bạn cần đăng nhập để thanh toán.";
            header('Location: ?act=login');
            exit();
        }

        $user_id = $_SESSION['user']['user_id'];
        $cart = $this->cartModel->getCartByUserId($user_id);

        if (!$cart) {
            $_SESSION['error'] = "Giỏ hàng của bạn đang trống.";
            header('Location: ?act=viewcart');
            exit();
        }

        $cart_items = $this->cartModel->getCartItems($cart['cart_id']);
        include 'view/pagines/cart/checkout.php';
    }

    public function deleteCart($cart_item_id)
    {
        if (! isset($cart_item_id)){
            $_SESSION['message'] = "Lỗi: Không tìm thấy sản phẩm cần xóa!";
            header("Location: ?act=viewcart");
            exit();
        }

        // Gọi model để xóa sản phẩm
        $success = $this->cartModel->deleteCartItem($cart_item_id);

        if ($success) {
            $_SESSION['message'] = "Sản phẩm đã được xóa!";
        } else {
            $_SESSION['message'] = "Xóa thất bại!";
        }

        // Chuyển hướng về trang giỏ hàng sau khi xóa
        header("Location: ?act=viewcart");
        exit();
    }
}
