<?php

require_once 'model/Product.php';
require_once 'model/Category.php';
class productController
{
    public $product;
    public $category;
    public function __construct()
    {
        $this->product = new Product();
        $this->category = new Category();
    }
    public function listProductsController()
    {
        $listProducts = $this->product->getProductModel();
        require_once 'view/pagines/product/listProduct.php';
    }
    public function detailProductsController($product_id)
    {
        $detailProducts = $this->product->getProductByIdModel($product_id);
        require_once 'view/pagines/product/ProductDetail.php';
    }
}
