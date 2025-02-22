<?php
ob_start();
session_start();
require_once '../commons/function.php';
//model
require_once '../admin/model/Category.php';
require_once '../admin/model/Product.php';
require_once '../admin/model/Order.php';
//controller
require_once '../admin/controller/categoriesController.php';
require_once '../admin/controller/productController.php';
include '../admin/view/layout/header.php';
require_once '../admin/controller/orderController.php';

$act = isset($_GET['act']) ? $_GET['act'] : '';
switch ($act) {
    case 'index':
        include '../admin/view/layout/home.php';
        break;
    case 'logout':
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']); // Xóa thông tin người dùng khỏi session
        }
        header('Location: ../?act=login'); // Chuyển hướng về trang login trong view
        exit(); // Thêm exit() để đảm bảo việc chuyển hướng được thực thi ngay lập tức
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
    default:
        header('Location: ?act=index');
        break;
}
include '../admin/view/layout/footer.php';
ob_end_flush();
