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
        $sql  = "SELECT * FROM cart_items WHERE cart_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$cart_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về danh sách sản phẩm trong giỏ hàng
    }
    public function addToCart($cart_id,$cart_name, $img, $quantity)
    {
        $sql = "INSERT INTO `cart_items` ( `cart_id`, `cart_name`, `img`, `quantity`) VALUES ($cart_id,'$cart_name', '$img', $quantity)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute();
    }
}
