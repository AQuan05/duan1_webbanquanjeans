<?php
ob_start();
session_start();
require_once 'commons/function.php';

// model
require_once 'model/Account.php';
require_once 'model/shopModel.php';
require_once 'model/Cart.php';
require_once 'model/Pay.php';
// controller
require_once 'controller/AccountController.php';
require_once 'controller/shopController.php';
require_once 'controller/ValidateController.php';
require_once 'controller/CartController.php';
require_once 'controller/PayController.php';

if (isset($_GET['act']) && $_GET['act'] != '' ) {
    // if(!isset($_SESSION['mycart'])) $_SESSION['mycart']=[];
    $act    = $_GET['act'] ?? '/';
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
        case 'viewcart':
            $cartController = new CartController();
            $cartController->viewcart(); // Chạy hàm hiển thị giỏ hàng
            break;
        case 'cart':
            $CartController = new CartController();
            $CartController->addToCart();
            break;
        case 'updateCartQuantity':
            $CartController = new CartController();
            $CartController->updateCartQuantity();
            break;
        case 'checkout':
            $cartController = new CartController();
            $cartController->viewCheckout();
            break;
        case 'payment':
            $payController = new PayController();
            $payController->placeOrder();
            break;
        case 'deletecart':
            $cartController = new CartController();
            $cartController->deleteCart($_POST['cart_item_id']);
            break;
        case 'logout':
            if (isset($_SESSION['user'])) {
                unset($_SESSION['user']); // Xóa thông tin user trong session
            }
            session_destroy(); // Hủy toàn bộ session
            header("Location: ?act=/"); // Chuyển hướng về trang chủ
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
