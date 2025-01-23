<?php
require_once 'commons/function.php';
//model
require_once 'model/Product.php';
require_once 'model/Category.php';
// controller
require_once 'controller/productController.php';
include 'view/layout/header.php';

if (isset($_GET['act']) && $_GET['act'] != '') {
    $act = $_GET['act'];
    switch ($act) {
        case '/':
            include 'view/pagines/product/home.php';
            break;
        case 'listProducts':
            $productController = new ProductController();
            $productController->listProductsController();
            break;
        case 'detailProducts':
            $productController = new ProductController();
            $productController->detailProductsController($_GET['product_id']);
            break;
    }
} else {

    include 'view/pagines/product/home.php';
}

include 'view/layout/footer.php';
