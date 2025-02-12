<?php
class Cart
{
    public $conn;
    public function __construct()
    {
        $this->conn = DB();
    }
    public function listCart($user_id)
    {
        $sql  = "SELECT ci.cart_item_id, ci.cart_id, ci.cart_name, ci.img, ci.quantity, ci.total_price, ci.price 
             FROM cart_items ci
             JOIN carts c ON ci.cart_id = c.cart_id
             WHERE c.user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getCartByUserId($user_id)
    {
        $sql  = "SELECT cart_id FROM carts WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addToCart($cart_id, $cart_name, $img, $quantity, $price)
    {
        // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
        $sql_check  = "SELECT * FROM cart_items WHERE cart_id = ? AND cart_name = ?";
        $stmt_check = $this->conn->prepare($sql_check);
        $stmt_check->execute([$cart_id, $cart_name]);
        $existingItem = $stmt_check->fetch(PDO::FETCH_ASSOC);

        if ($existingItem) {
            // Nếu sản phẩm đã có, cập nhật số lượng và tổng giá
            $newQuantity   = $existingItem['quantity'] + $quantity;
            $newTotalPrice = $newQuantity * $price; // Cập nhật total_price

            $sql_update  = "UPDATE cart_items SET quantity = ?, total_price = ? WHERE cart_id = ? AND cart_name = ?";
            $stmt_update = $this->conn->prepare($sql_update);
            return $stmt_update->execute([$newQuantity, $newTotalPrice, $cart_id, $cart_name]);
        } else {
            // Nếu sản phẩm chưa có, thêm mới
            $total_price = $price * $quantity;
            $sql_insert  = "INSERT INTO cart_items (cart_id, cart_name, img, quantity, price, total_price) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt_insert = $this->conn->prepare($sql_insert);
            return $stmt_insert->execute([$cart_id, $cart_name, $img, $quantity, $price, $total_price]);
        }
    }
    public function updateCartItemQuantity($cart_item_id, $quantity)
    {
        // Lấy giá sản phẩm từ database
        $sql_get_price  = "SELECT price FROM cart_items WHERE cart_item_id = ?";
        $stmt_get_price = $this->conn->prepare($sql_get_price);
        $stmt_get_price->execute([$cart_item_id]);
        $item = $stmt_get_price->fetch(PDO::FETCH_ASSOC);

        if ($item) {
            $price       = (float) $item['price']; // Lấy giá sản phẩm
            $total_price = $price * $quantity;     // Tính total_price

            // Cập nhật quantity và total_price vào database
            $sql_update  = "UPDATE cart_items SET quantity = ?, total_price = ? WHERE cart_item_id = ?";
            $stmt_update = $this->conn->prepare($sql_update);
            return $stmt_update->execute([$quantity, $total_price, $cart_item_id]);
        }
        return false;
    }

    public function deleteCartItem($cart_item_id)
    {
        $sql  = "DELETE FROM cart_items WHERE cart_item_id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$cart_item_id]);
    }
}
