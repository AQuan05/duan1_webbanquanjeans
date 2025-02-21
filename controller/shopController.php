<?php
require_once 'model/shopModel.php';
class shopController
{
    public $shopModel;
    public function __construct()
    {
        $this->shopModel = new shopModel();
    }
    public function allProducts()
    {
        $searchKey = isset($_POST['search']) ? trim($_POST['search']) : '';
    
        if (!empty($searchKey)) {
            $products = $this->shopModel->searchProduct($searchKey);
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
            $product = $this->shopModel->searchProduct($_POST['search']);
        } else {
            $product = $this->shopModel->cat_pro($id);
        }
        $category = $this->shopModel->allCategories();
        require_once 'view/pagines/product/Shop.php';
    }
}
