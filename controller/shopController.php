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
        if (isset($_POST['search'])) {
            $product = $this->shopModel->searchProduct($_POST['search']);
        } else {
            $product = $this->shopModel->allProducts();
        }
        $category = $this->shopModel->allCategories();
        require_once 'view/pagines/product/Shop.php';
    }
    public function productDetails($product_id)
    {
        if (isset($_POST['search'])) {
            $product = $this->shopModel->searchProduct($_POST['search']);
        }
    
        $productOne = $this->shopModel->getProductByIdModel($product_id);
        $variants = $this->shopModel->VariantsByProductId($product_id);
    
        // Handle selected variant
        $selectedVariant = null;
        if (isset($_GET['variant_id'])) {
            $variant_id = $_GET['variant_id'];
            $selectedVariant = $this->shopModel->getVariantById($variant_id);
        } else {
            // Default to the first variant if no variant is selected
            $selectedVariant = $variants[0] ?? null;  // Use null coalescing operator
        }
    
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
