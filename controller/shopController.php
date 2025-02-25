<?php
require_once 'model/shopModel.php';
require_once 'model/Comment.php';
class shopController
{
    public $shopModel;
    public $commentModel;
    public function __construct()
    {
        $this->shopModel = new shopModel();
        $this->commentModel = new Comment();
    }
    public function allProducts()
    {
        if (isset($_POST['search'])) {
            $products = $this->shopModel->searchProduct($_POST['search']);
        } else {
            $products = $this->shopModel->allProducts();
        }
        $categories = $this->shopModel->allCategories();
        require_once 'view/pagines/product/Shop.php';
    }

    public function productDetails($product_id)
    {
        // Nếu có tìm kiếm, lấy sản phẩm theo từ khóa
        if (isset($_POST['search'])) {
            $product = $this->shopModel->searchProduct($_POST['search']);
        }
        // Lấy thông tin sản phẩm hiện tại
        $productOne = $this->shopModel->getProductByIdModel($product_id);
        $order_id = $_GET['order_id'] ?? null; // Hoặc $_POST nếu gửi bằng form

        $comments = $this->commentModel->getCommentsByProduct($product_id, $order_id);

        // Kiểm tra nếu sản phẩm không tồn tại
        if (!$productOne) {
            echo "Sản phẩm không tồn tại!";
            return;
        }
        // Lấy danh sách sản phẩm liên quan
        $similarProducts = $this->shopModel->getSimilarProducts($productOne['category_id'], $product_id);
        // Đưa dữ liệu ra view
        require_once 'view/pagines/product/shopSingle.php';
    }

    public function shopCategory($id)
    {
        if (isset($_POST['search'])) {
            $products = $this->shopModel->searchProduct($_POST['search']);
        } else {
            $products = $this->shopModel->cat_pro($id);
        }
        $categories = $this->shopModel->allCategories();
        require_once 'view/pagines/product/Shop.php';
    }
}
