<?php
class Category {
    public $conn;

    function __construct() {
        $this->conn = DB();
    }

    function listCategory() {
        $sql = "SELECT * FROM category";    
        return $this->conn->query($sql)->fetchAll();
    }
}
