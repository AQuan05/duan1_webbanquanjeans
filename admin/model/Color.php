<?php

class Color
{
    public $conn;
    public function __construct()
    {
        $this->conn = DB();
    }
    function listColorModel()
    {
        $sql = "SELECT * FROM color";
        return $this->conn->query($sql)->fetchAll();
    }
    function addColorModel($color_name)
    {
        $sql = "INSERT INTO color (color_name) VALUES ('$color_name')";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute();
    }
    function findColorModelById($color_id) {
        $sql = "SELECT * FROM color WHERE color_id = $color_id";
        return $this->conn->query($sql)->fetch();
    }
}
