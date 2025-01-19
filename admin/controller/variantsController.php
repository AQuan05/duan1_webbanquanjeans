<?php
require_once '../admin/model/Variant.php';
class variantsController
{
    public $Variant;
    public function __construct()
    {
        $this->Variant = new Variant();
    }
    public function listVariantsController()
    {
        $variants = $this->Variant->listVariantsModel();
        require_once '../admin/view/pagines/variants/listVariants.php';
    }

    function addVariantsController()
    {
        // Lấy danh sách sản phẩm từ Model
        $products = $this->Variant->GetAllProducts();
    
        // Hiển thị giao diện thêm Variant
        require_once '../admin/view/pagines/variants/addVariants.php';
    
        // Xử lý thêm Variant khi form được submit
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addVariant'])) {
            // Lấy dữ liệu từ form
            $color = trim($_POST['color']);
            $size = trim($_POST['size']);
            $product_id = intval($_POST['product_id']); // Chuyển thành kiểu số nguyên để đảm bảo an toàn
            $price = intval($_POST['price']);
            // Kiểm tra dữ liệu đầu vào
            if (empty($color) || empty($size) || $product_id <= 0 || $price <= 0) {
                echo 'Vui lòng điền đầy đủ thông tin hợp lệ.';
                return;
            }
    
            // Thêm variant vào cơ sở dữ liệu
            if ($this->Variant->addVariantsModel($color, $size, $product_id, $price)) {
                header('Location: ?act=listVariants');
                exit; // Đảm bảo không chạy tiếp code bên dưới
            } else {
                echo 'Thêm không thành công. Vui lòng thử lại.';
            }
        }
    }
    function deleteVariantsController($variant_id)
    {
        $variant_id = $_GET['variant_id'];
        if ($this->Variant->deleteVariantsModel($variant_id)) {
            header('Location: ?act=listVariants');
        }
    }
    
}
