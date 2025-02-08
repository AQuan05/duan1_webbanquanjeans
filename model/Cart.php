<?php
class Cart
{
    public $conn;
    public function __construct()
    {
        $this->conn = DB();
    }
    public function listCart($cart_id)
    {
        $sql  = "SELECT `cart_item_id`, `cart_id`, `cart_name`, `img`, `quantity` FROM `cart_items` WHERE cart_id = $cart_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về danh sách sản phẩm trong giỏ hàng
    }
    public function addToCart($cart_id, $cart_name, $img, $quantity)
    {
        // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
        $sql_check  = "SELECT * FROM `cart_items` WHERE cart_id = $cart_id AND cart_name = $cart_name";
        $stmt_check = $this->conn->prepare($sql_check);
        $stmt_check->execute();
        $existingItem = $stmt_check->fetch(PDO::FETCH_ASSOC);

        if ($existingItem) {
            // Nếu sản phẩm đã có, cập nhật số lượng
            $newQuantity = $existingItem['quantity'] + $quantity;
            $sql_update  = "UPDATE `cart_items` SET quantity = $newQuantity WHERE cart_id = $cart_id AND cart_name = $cart_name";
            $stmt_update = $this->conn->prepare($sql_update);
            return $stmt_update->execute();
        } else {
            // Nếu sản phẩm chưa có, thêm mới
            $sql_insert  = "INSERT INTO `cart_items` (`cart_id`, `cart_name`, `img`, `quantity`) VALUES ($cart_id, $cart_name, $img, $quantity)";
            $stmt_insert = $this->conn->prepare($sql_insert);
            return $stmt_insert->execute();
        }
    }

    public function deleteCartItem($cart_item_id)
    {
        $sql  = "DELETE FROM cart_items WHERE cart_item_id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$cart_item_id]);
    }

}
