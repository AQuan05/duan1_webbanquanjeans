<?php
require_once 'model/Cart.php';

class cartController
{
    private $cartModel;

    public function __construct()
    {
        $this->cartModel = new Cart();
    }
    public function viewcart()
    {
        $cart_id = 1; // Nếu chưa có đăng nhập, sử dụng giỏ hàng tạm thời với cart_id = 0

        // Lấy danh sách sản phẩm trong giỏ hàng từ model
        $cartItems = $this->cartModel->listCart($cart_id);

        // Gửi dữ liệu sang view
        include "view/pagines/cart/viewcart.php";
    }

    public function addToCart()
    {
        if (isset($_POST['add_to_cart'])) {
            $cart_id   = 1;
            $cart_name = $_POST['cart_name'];
            $img       = $_POST['image'];
            $quantity  = $_POST['quantity'];
            $this->cartModel->addToCart($cart_id, $cart_name, $img, $quantity);
            header("Location: ?act=viewcart");
            exit();
        }
    }
    public function deleteCart($cart_item_id)
    {
        if (! isset($cart_item_id)) {
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
