<?php
ob_start();
session_start();
require_once 'commons/function.php';


// model
require_once 'model/Account.php';

// controller
require_once 'controller/AccountController.php';
require_once 'controller/ValidateController.php';


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
            $productController = new productController();
            $productController->listProductsController();
            break;

        case 'register':
            $AccountController = new AccountController();
            $AccountController->addAccController();
            break;
        case 'login':
            $AccountController = new AccountController();
            $AccountController->loginController();
            break;
        case 'forgotPassword':
            $AccountController = new AccountController();
            $AccountController->forgotPasswordController();
            break;
        case 'resetPassword':
            $AccountController = new AccountController();
            $AccountController->resetPasswordController();
            break;
        case 'logout':
            session_destroy();
            header('Location: ?act=index');
            exit();
            break;
        case 'ProductCategory':
            include 'view/pagines/ProductCategory.php';
            break;
        case 'ProductDetail':
            include 'view/pagines/ProductDetail.php';
            break;
        case 'About':
            include 'view/pagines/pages/About.php';
            break;
        case 'Contact':
            include 'view/pagines/pages/Contact.php';
            break;
        case 'Policy':
            include 'view/pagines/pages/Policy.php';
            break;
        case 'Faq':
            include 'view/pagines/pages/Faq.php';
            break;
        // case 'detailProducts':
        //     $productController = new ProductController();
        //     $productController->detailProductsController($_GET['product_id']);
        //     break;
    }
} else {

    include 'view/pagines/product/home.php';
}

include 'view/layout/footer.php';
ob_end_flush();
