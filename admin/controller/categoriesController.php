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
            exit();
        }
    }
    function deleteCategoriesController($category_id)
    {
        // Kiểm tra $category_id có hợp lệ hay không
        if (empty($category_id) || !is_numeric($category_id)) {
            echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "error",
                title: "Lỗi!",
                text: "ID danh mục không hợp lệ.",
                showConfirmButton: true
            });
        });
        </script>';
            exit();
        }

        // Thực hiện xóa danh mục
        if ($this->categories->deleteCategoriesModel($category_id)) {
            echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "success",
                title: "Thành công!",
                text: "Xóa danh mục thành công.",
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
                text: "Không thể xóa danh mục, vui lòng thử lại.",
                showConfirmButton: true
            });
        });
        </script>';
        }

        exit();
    }
    function updateCategoriesController($category_id)
    {
        $oneCategory = $this->categories->findCategoryModel($category_id);
        require_once '../admin/view/pagines/category/editCategories.php';
        if (isset($_POST['updateCate'])) {
            $category_id = $_POST['category_id'];
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
            if ($this->categories->updateCategoriesModel($category_id, $name)) {
                echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "success",
                        title: "successfully!",
                        text: "Update category successfully.",
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
                        text: "Không thể thêm danh mục, vuiが thử lagi.",
                        showConfirmButton: true
                    });
                });
            </script>';
            }
            exit();
        }
    }
    public function listCategories()
    {
        $Categories = $this->categories->listCategoriesModel();
        require_once '../admin/view/pagines/category/listCategories.php';
    }
    function addCategory()
    {
        if (isset($_POST['add']) && ($_POST['add'])) {
            $name = $_POST['name'];
            $this->categories->addCategoriesModel($name);
        }
    }
}
