<?php
require_once '../admin/model/Category.php';

class categoriesController
{
    public $categories;
    public function __construct()
    {
        $this->categories = new Category();
    }
    public function listCategoriesController()
    {
        $Categories = $this->categories->listCategoriesModel();
        require_once '../admin/view/pagines/category/listCategories.php';
    }
    function addCategoriesController()
    {
        require_once '../admin/view/pagines/category/addCategories.php';
        if (isset($_POST['addCate'])) {
            $name = htmlspecialchars(trim($_POST['name_cate']));
            if (empty($name)) {
                echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "warning",
                        title: "Error!",
                        text: "Category name cannot be empty!.",
                        showConfirmButton: true
                    });
                });
            </script>';
                return;
            }
            if (strlen($name) < 5) {
                echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "warning",
                        title: "Error!",
                        text: "Category name cannot be less than 5.",
                        showConfirmButton: true
                    });
                });
            </script>';
                return;
            }
            if ($this->categories->addCategoriesModel($name)) {
                echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "success",
                        title: "successfully!",
                        text: "Add category successfully.",
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        window.location.href = "index.php?act=listCategories";
                    });
                });
            </script>';
            } else {
                echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "error",
                        title: "Thất bại!",
                        text: "Không thể thêm danh mục, vui lòng thử lại.",
                        showConfirmButton: true
                    });
                });
            </script>';
            }
            exit;
        }
    }
}