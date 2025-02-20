<?php
require_once 'model/Product.php';

class ProductController
{
    public $product;
    public function __construct()
    {
        $this->product = new Product();
    }
    public function showLatestProducts($limit = 8)
    {
        $top8Products = $this->product->getTop8Product($limit);
        include 'view/pagines/product/home.php';
    }
}
