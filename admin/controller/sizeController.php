<?php
require_once '../admin/model/Size.php';

class SizeController{

    public $Size;
    public function __construct(){
        $this->Size = new Size();
    }
    public function listSizesController(){
        $listSize = $this->Size->listSizeModel();
        require_once '../admin/view/pagines/size/listSize.php';
    }
    function addSizeController()
    {
        require_once '../admin/view/pagines/size/addSize.php';
        if (isset($_POST['addSize'])) {
            $size_name = !empty($_POST['size_name']) ? htmlspecialchars($_POST['size_name']) : null;
            if (empty($size_name)) {
                echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "warning",
                        title: "Error!",
                        text: "Size name cannot be empty!.",
                        showConfirmButton: true
                    });
                });
            </script>';
                return;
            }
            if ($this->Size->addSizeModel($size_name)) {
                echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "success",
                        title: "successfully!",
                        text: "Add size successfully.",
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        window.location.href = "index.php?act=listSize";
                    });
                });
            </script>';
            } else {
                echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "error",
                        title: "Thất bại!",
                        text: "Không thể thêm size, vui lòng thử lại.",
                        showConfirmButton: true
                    });
                });
            </script>';
            }
            exit();
        }
    }
}