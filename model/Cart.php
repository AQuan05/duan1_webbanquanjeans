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
        $sql  = "SELECT ci.cart_item_id, ci.cart_id, p.product_id, p.product_name, p.image, 
                        ci.quantity, ci.total_price, ci.price 
                 FROM cart_items ci
                 JOIN carts c ON ci.cart_id = c.cart_id
                 JOIN products p ON ci.product_id = p.product_id
                 WHERE c.user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getCartItemByProductId($cart_id, $product_id) {
        $sql  = "SELECT * FROM cart_items WHERE cart_id = ? AND product_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$cart_id, $product_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getCartItemsByUserId($user_id) {
        $sql  = "SELECT * FROM cart_items WHERE cart_id = (SELECT cart_id FROM carts WHERE user_id = ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getCartItems($cart_id) {
        $query = "SELECT ci.*,p.image,p.product_name FROM cart_items ci
        JOIN products p ON ci.product_id = p.product_id WHERE cart_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$cart_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getCartByUserId($user_id)
    {
        $sql  = "SELECT cart_id FROM carts WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addToCart($cart_id, $product_id, $quantity, $price)
    {
        // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
        $sql_check  = "SELECT * FROM cart_items WHERE cart_id = ? AND product_id = ?";
        $stmt_check = $this->conn->prepare($sql_check);
        $stmt_check->execute([$cart_id, $product_id]);
        $existingItem = $stmt_check->fetch(PDO::FETCH_ASSOC);
    
        if ($existingItem) {
            // Nếu sản phẩm đã có, cập nhật số lượng và tổng giá
            $newQuantity   = $existingItem['quantity'] + $quantity;
            $newTotalPrice = $newQuantity * $price; // Cập nhật total_price
    
            $sql_update  = "UPDATE cart_items SET quantity = ?, total_price = ? WHERE cart_id = ? AND product_id = ?";
            $stmt_update = $this->conn->prepare($sql_update);
            return $stmt_update->execute([$newQuantity, $newTotalPrice, $cart_id, $product_id]);
        } else {
            // Lấy thông tin sản phẩm từ bảng products
            $sql_product  = "SELECT product_name, image FROM products WHERE product_id = ?";
            $stmt_product = $this->conn->prepare($sql_product);
            $stmt_product->execute([$product_id]);
            $product = $stmt_product->fetch(PDO::FETCH_ASSOC);
    
            if (!$product) {
                return false; // Trả về false nếu sản phẩm không tồn tại
            }
    
            // Nếu sản phẩm chưa có, thêm mới
            $total_price = $price * $quantity;
            $sql_insert  = "INSERT INTO cart_items (cart_id, product_id, quantity, price, total_price) VALUES (?, ?, ?, ?, ?)";
            $stmt_insert = $this->conn->prepare($sql_insert);
            return $stmt_insert->execute([$cart_id, $product_id, $quantity, $price, $total_price]);
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
