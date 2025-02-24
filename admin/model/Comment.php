<?php

class Comment
{
    public $conn;
    public function __construct()
    {
        $this->conn = DB();
    }
    public function listCommentsModel()
    {
        $sql = "SELECT c.content, c.created_at, u.username AS user_name, o.order_id
            FROM comments c
            JOIN users u ON c.user_id = u.user_id
            JOIN orders o ON c.order_id = o.order_id
            ORDER BY c.created_at DESC";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}
