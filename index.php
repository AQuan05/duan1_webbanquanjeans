<?php
ob_start();
session_start();
require_once 'commons/function.php';

// model
require_once 'model/Account.php';
require_once 'model/shopModel.php';
require_once 'model/Cart.php';
require_once 'model/Pay.php';
require_once 'model/Product.php';
require_once 'model/Order.php';
require_once 'model/Comment.php';
// controller
require_once 'controller/AccountController.php';
require_once 'controller/shopController.php';
require_once 'controller/ValidateController.php';
require_once 'controller/CartController.php';
require_once 'controller/PayController.php';
require_once 'controller/ProductController.php';
require_once 'controller/OrderController.php';
require_once 'controller/CommentController.php';

if (isset($_GET['act']) && $_GET['act'] != '') {
    // if(!isset($_SESSION['mycart'])) $_SESSION['mycart']=[];
    $act    = $_GET['act'] ?? '/';
    $action = $_GET['action'] ?? '';
    switch ($act) {
        case '/':
            $productController = new ProductController();
            $productController->showLatestProducts();
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
        case 'success':
            include 'view/pagines/cart/success.php';
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
        case 'listOrder':
            $orderController = new OrderController();

            // Kiểm tra nếu có user_id trong URL
            $user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;

            if ($user_id > 0) {
                $orderController->listOrdersByUser($user_id);
            } else {
                echo "Vui lòng cung cấp user_id hợp lệ.";
            }
            break;
        case 'orderDetail':
            $orderController = new OrderController();
            $order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;
            $orderController->orderDetails($order_id);
            break;
        case 'addComment':
            $commentController = new CommentController();
            $commentController->store();
            break;
        case 'review':
            $order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;
            $product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : 0;

            // Lấy thông tin sản phẩm từ database
            $shopModel = new ShopModel();
            $productOne = $shopModel->getProductByIdModel($product_id);            
            // Kiểm tra nếu sản phẩm không tồn tại
            if (!$productOne) {
                echo "<p class='text-danger'>Sản phẩm không tồn tại hoặc đã bị xóa.</p>";
                exit();
            }
            require_once 'view/pagines/product/shopSingle.php';
            break;
        case 'editprofile':
            $AccountController = new AccountController();
            $AccountController->edit($_GET['user_id']);
            break;
        case 'orders':
            $orderController = new OrderController();
            $orderController->index();
            break;
        default:
            echo "Trang bạn tìm kiếm không tồn tại.";
            break;
    }
} else {
    header('Location: ?act=/');
}
ob_end_flush();
