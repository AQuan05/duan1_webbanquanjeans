<?php

function DB(){
    $host = "mysql:host=localhost;dbname=da1;charset=utf8";
    $username = "root";
    $password = "";
    try {
        $conn = new PDO($host, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}