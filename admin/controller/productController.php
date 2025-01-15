<?php
require_once '../admin/model/Product.php';
class productController{
    public $Product;
    public function __construct() {
        $this->Product = new Product();
    }
    public function listProduct(){
        $listProducts = $this->Product->listProduct();
        require_once '../admin/view/pagines/product/listProducts.php';
    }
}