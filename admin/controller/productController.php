<?php
require_once '../admin/model/Product.php';
class productController
{
    public $Product;
    public function __construct()
    {
        $this->Product = new Product();
    }
    public function listProductsController()
    {
        $listProducts = $this->Product->listProductModel();
        // $Categories = $this->Product->getProductsWithCategoryNames();
        require_once '../admin/view/pagines/product/listProducts.php';
    }
    public function addProductsController()
    {
        $Categories = $this->Product->getProductsWithCategoryNames();
        require_once '../admin/view/pagines/product/addProducts.php';

        if (isset($_POST['addPro'])) {
            // Lấy giá trị từ form
            $product_name = $_POST['product_name'];
            $category_id = $_POST['category_id'];
            $description = $_POST['description'];
            $image = ''; // Khởi tạo image mặc định

            // Kiểm tra và xử lý hình ảnh nếu có
            if ($_FILES['image']['name'] != '') {
                $image = $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], '../admin/view/assets/images/products/' . $image);
            }

            // Gọi phương thức thêm sản phẩm vào cơ sở dữ liệu
            // var_dump($this->Product->addProductModel($product_name, $image, $category_id, $description)); // Debugging
            // print_r($_POST);
            // exit();
            if ($this->Product->addProductModel($product_name, $image, $category_id, $description)) {
                // Nếu thêm thành công, chuyển hướng đến trang danh sách sản phẩm
                echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "success",
                title: "successfully!",
                text: "Add category successfully.",
                showConfirmButton: false,
                timer: 2000
            }).then(() => {
            window.location.href = "index.php?act=listProducts";
            });
        });
    </script>';
            } else {
                echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "error",
                title: "Failed!",
                text: "Not add products, please try again.",
                showConfirmButton: true
            });
        });
    </script>';
            }
            exit();
        }
    }
    public function deleteProductController($product_id)
    {
        $product_id = $_GET['id'];
        // if (isset($_GET['product_id'])) {
        // $product_id = $_GET['product_id'];
        if ($this->Product->deleteProductModel($product_id)) {
            echo 'Xoa thanh cong';
            header('location: ?act=listProducts');
            // exit
        }
        // }
    }
    function updateProductController($product_id)
{
    $Categories = $this->Product->getProductsWithCategoryNames();
    $oneProduct = $this->Product->findProductModel($product_id);
    require_once '../admin/view/pagines/product/editProduct.php';
    if (isset($_POST['updatePro'])) {
        $product_id = $_POST['product_id'];
        $description = $_POST['description'];
        $category_id = $_POST['category_id'];
        $product_name = htmlspecialchars(trim($_POST['product_name']));

        // Validate product name
        if (empty($product_name)) {
            echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "warning",
                    title: "Error!",
                    text: "Product name cannot be empty!",
                    showConfirmButton: true
                });
            });
        </script>';
            return;
        }
        if (strlen($product_name) < 5) {
            echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "warning",
                    title: "Error!",
                    text: "Product name cannot be less than 5.",
                    showConfirmButton: true
                });
            });
        </script>';
            return;
        }

        // Handle image upload
        $image = $oneProduct['image']; // Keep current image by default
        if (isset($_FILES['image']) && $_FILES['image']['name'] != "") {
            $targetDir = "../admin/view/assets/images/products/";
            $imageName = basename($_FILES['image']['name']);
            $targetFile = $targetDir . $imageName;

            // Check if upload is successful
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                // Delete old image if exists
                if (file_exists($targetDir . $oneProduct['image'])) {
                    unlink($targetDir . $oneProduct['image']);
                }
                $image = $imageName;
            } else {
                echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "error",
                        title: "Upload Failed!",
                        text: "Failed to upload the image.",
                        showConfirmButton: true
                    });
                });
            </script>';
                return;
            }
        }

        // Update product information
        if ($this->Product->updateProductModel($product_id, $product_name, $image, $category_id, $description)) {
            echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "success",
                    title: "Success!",
                    text: "Product updated successfully.",
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    window.location.href = "index.php?act=listProducts";
                });
            });
        </script>';
        } else {
            echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "error",
                    title: "Failed!",
                    text: "Unable to update the product. Please try again.",
                    showConfirmButton: true
                });
            });
        </script>';
        }
        exit();
    }
}

}
