<?php
require_once '../admin/model/Product.php';
class productController{
    public $Product;
    public function __construct() {
        $this->Product = new Product();
    }
    public function listProduct(){
        // $listProduct = $this->Product->listProduct();
        // require_once 'admin/view/pagines/product/listProduct.php';
        return '../admin/view/pagines/product/listProduct.php';
    }

}