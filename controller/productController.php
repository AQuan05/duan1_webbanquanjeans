<?php
require_once '../model/Product.php';

class ProductController{
    public $product;
    public function __construct(){
        $this->product = new Product();
    }
    public function listProducts(){
        $products = $this->product->listProduct();
        require_once '../view/pagines/product/ProductFullWidth.php';
    }
}