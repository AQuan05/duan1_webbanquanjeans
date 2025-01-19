<?php
require_once '../admin/model/Product.php';
require_once '../admin/model/Size.php';
require_once '../admin/model/Color.php';
require_once '../admin/model/Variant.php';
class productController
{
    public $Product;
    public $Color;
    public $Size;
    public $Variant;
    public function __construct()
    {
        $this->Product = new Product();
        $this->Color = new Color();
        $this->Size = new Size();
        $this->Variant = new Variant();
    }
    public function listProductsController()
    {
        $listProducts = $this->Product->listProductModel();
        foreach ($listProducts as &$product) {
            $product_id = $product['product_id'];
            $variants = $this->Variant->getVariantsByProductId($product_id);
            $product['variants'] = $variants;
        }
        require_once '../admin/view/pagines/product/listProducts.php';
    }
    public function addProductsController()
    {
        $Categories = $this->Product->getProductsWithCategoryNames();
        $color = $this->Color->listColorModel();
        $size = $this->Size->listSizeModel();
        require_once '../admin/view/pagines/product/addProducts.php';

        if (isset($_POST['addPro'])) {
            $product_name = $_POST['product_name'];
            $category_id = $_POST['category_id'];
            $description = $_POST['description'];
            $image = '';
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
            if ($_FILES['image']['name'] != '') {
                $image = $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], '../admin/view/assets/images/products/' . $image);
            }
            if ($this->Product->addProductModel($product_name, $image, $category_id, $description)) {
                $product_id = $this->Product->getLastInsertedId();
                if (!empty($_POST['color_id']) && !empty($_POST['size_id'])) {
                    $color_ids = $_POST['color_id'];
                    $size_ids = $_POST['size_id'];
                    $prices = $_POST['price'];

                    foreach ($color_ids as $key => $color_id) {
                        $size_id = $size_ids[$key];
                        $color_id = $color_ids[$key];
                        $price = $prices[$key];
                        $this->Variant->addProductvariantsModel($product_id, $size_id, $color_id, $price);
                    }
                }
                echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "success",
                        title: "Successfully!",
                        text: "Add product and variants successfully.",
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
                        text: "Failed to add product. Please try again.",
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
        if ($this->Product->deleteProductModel($product_id)) {
            echo 'Xoa thanh cong';
            header('location: ?act=listProducts');
            // exit
        }
        // }
    }
    function updateProductController($product_id)
    {
        // Lấy dữ liệu cần thiết từ model
        $Categories = $this->Product->getProductsWithCategoryNames();
        $oneProduct = $this->Product->findProductModel($product_id);
        $color = $this->Color->listColorModel();
        $size = $this->Size->listSizeModel();
        $variants = $this->Variant->getVariantsByProductId($product_id);

        // Hiển thị trang editProduct
        require_once '../admin/view/pagines/product/editProduct.php';

        // Xử lý khi form được submit
        if (isset($_POST['updatePro'])) {
            // Lấy dữ liệu từ form
            $product_id = $_POST['product_id'];
            $description = htmlspecialchars(trim($_POST['description']));
            $category_id = $_POST['category_id'];
            $product_name = htmlspecialchars(trim($_POST['product_name']));

            // Validate tên sản phẩm
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
                            text: "Product name must be at least 5 characters.",
                            showConfirmButton: true
                        });
                    });
                </script>';
                return;
            }

            // Xử lý upload ảnh
            $image = $oneProduct['image']; // Giữ nguyên ảnh hiện tại nếu không thay đổi
            if (isset($_FILES['image']) && $_FILES['image']['name'] != "") {
                $targetDir = "../admin/view/assets/images/products/";
                $imageName = basename($_FILES['image']['name']);
                $targetFile = $targetDir . $imageName;

                // Kiểm tra và upload ảnh
                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                    // Xóa ảnh cũ nếu tồn tại
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

            // Cập nhật thông tin sản phẩm
            $updateSuccess = $this->Product->updateProductModel($product_id, $product_name, $image, $category_id, $description);

            if ($updateSuccess) {
                // Nếu sản phẩm có biến thể, cập nhật thông tin biến thể
                if (!empty($_POST['variant_id'])) {
                    $variant_ids = $_POST['variant_id'];
                    $color_ids = $_POST['color_id'];
                    $size_ids = $_POST['size_id'];
                    $prices = $_POST['price'];

                    foreach ($variant_ids as $key => $variant_id) {
                        $color_id = $color_ids[$key];
                        $size_id = $size_ids[$key];
                        $price = $prices[$key];

                        // Cập nhật biến thể
                        $this->Variant->updateProductVariantModel($variant_id, $size_id, $color_id, $price);
                    }
                }
                // Hiển thị thông báo thành công
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
                // Hiển thị thông báo lỗi khi cập nhật thất bại
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
