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
            $cart_id     = 1;
            $cart_name   = $_POST['cart_name'];
            $img         = $_POST['image'];
            $quantity    = (int) $_POST['quantity'];
            $price       = (float) $_POST['price'];
            $total_price = $price * $quantity;

            // Gọi model với đúng thứ tự tham số
            $this->cartModel->addToCart($cart_id, $cart_name, $img, $quantity, $price, $total_price);

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
            $newQuantity  = max(1, $quantity + $change); // Không cho < 1

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
