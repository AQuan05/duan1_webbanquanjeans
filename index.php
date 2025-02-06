<?php
ob_start();
session_start();
require_once 'commons/function.php';

// model
require_once 'model/Account.php';
require_once 'model/shopModel.php';

// controller
require_once 'controller/AccountController.php';
require_once 'controller/shopController.php';
require_once 'controller/ValidateController.php';

if (isset($_GET['act']) && $_GET['act'] != '') {
    $act = $_GET['act'] ?? '/';
    $action = $_GET['action'] ?? '';
    switch ($act) {
        case '/':
            include 'view/pagines/product/home.php';
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
        case 'shop':
            $shopController = new ShopController();
            $shopController->allProducts();
            break;
        case 'shopSingle':
            $shopController = new shopController();
            $shopController->productDetails($_GET['product_id']);
            break;
        case 'shopCategory':
            $shopController = new shopController();
            $shopController->shopCategory($_GET['category_id']);
            break;
        case 'cart':
            include 'view/pagines/cart/viewcart.php';
            break;
        case 'logout':
            session_destroy();
            header('Location: ?act=index');
            exit();
            break;
        case 'ProductCategory':
            include 'view/pagines/ProductCategory.php';
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
    }
} else {
 header('Location: ?act=/');
}
ob_end_flush();
