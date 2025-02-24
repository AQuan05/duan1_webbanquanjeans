<?php
ob_start();
session_start();

require_once '../commons/function.php';
//model
require_once '../admin/model/Category.php';
require_once '../admin/model/Product.php';
require_once '../admin/model/Order.php';
require_once '../admin/model/Comment.php';
require_once '../admin/model/Account.php';
//controller
require_once '../admin/controller/categoriesController.php';
require_once '../admin/controller/productController.php';
include '../admin/view/layout/header.php';
require_once '../admin/controller/orderController.php';
require_once '../admin/controller/commentController.php';
require_once '../admin/controller/accountController.php';

// Kiểm tra nếu không có session user hoặc role khác 1 thì quay về trang chính
if (!isset($_SESSION['user']) || $_SESSION['user']['role_id'] != 1) {
    header('Location: ../?act=/');
    exit();
}

$act = isset($_GET['act']) ? $_GET['act'] : '';
switch ($act) {
    case 'index':
        $sumOrdersStatusSuccessController = new orderController();
        $sumOrdersStatusSuccessController->sumOrdersStatusSuccessController();
        break;
    case 'logout':
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']); // Xóa thông tin người dùng khỏi session
        }
        session_destroy(); // Hủy toàn bộ session
        header('Location: ../?act=login'); // Chuyển hướng về trang login
        exit(); // Đảm bảo việc chuyển hướng thực thi ngay lập tức
        break;
    case 'listCategories':
        $categoriesController = new categoriesController();
        $categoriesController->listCategoriesController();
        break;
    case 'addCategories':
        $categoriesController = new categoriesController();
        $categoriesController->addCategoriesController();
        break;
    case 'deleteCategories':
        $categoriesController = new categoriesController();
        $categoriesController->deleteCategoriesController($_GET['category_id']);
        break;
    case 'updateCategories':
        $categoriesController = new categoriesController();
        $categoriesController->updateCategoriesController($_GET['category_id']);
        break;
    case 'listProducts':
        $productsController = new productController();
        $productsController->listProductsController();
        break;
    case 'addProducts':
        $productsController = new productController();
        $productsController->addProductsController();
        break;
    case 'deleteProduct':
        $productsController = new productController();
        $productsController->deleteProductController($_GET['product_id']);
        break;
    case 'editProduct':
        $productsController = new productController();
        $productsController->updateProductController($_GET['product_id']);
        break;
    case 'listOrders':
        $orderController = new orderController();
        $orderController->listOrders();
        break;
    case 'detailOrder':
        $orderController = new orderController();
        $orderController->orderDetails($_GET['order_id']);
        break;
    case 'updateOrderStatus':
        $orderController = new orderController();
        $result = $orderController->updateOrderStatus($_POST['order_id'], $_POST['status_id']);

        if (!$result) {
            echo "Cập nhật trạng thái thất bại!";
        }
        break;
    case 'listComments':
        $commentController = new commentController();
        $commentController->listCommentsController();
        break;
    case 'listUsers':
        $accountController = new accountController();
        $accountController->listUserController();
        break;
    case 'detailUser':
        $accountController = new accountController();
        $accountController->detailUserController($_GET['user_id']);
        break;
    default:
        break;
}
include '../admin/view/layout/footer.php';
ob_end_flush();
