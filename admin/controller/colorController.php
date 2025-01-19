<?php

require_once '../admin/model/Color.php';

class ColorController{
    public $Color;
    public function __construct(){
        $this->Color = new Color();
    }

    public function listColorController(){
        $listColor = $this->Color->listColorModel();
        require_once '../admin/view/pagines/color/listColor.php';
    }
    public function addColorController(){
        require_once '../admin/view/pagines/color/addColor.php';
        if (isset($_POST['addColor'])) {
            $color_name = !empty($_POST['color_name']) ? htmlspecialchars($_POST['color_name']) : null;
            if (empty($color_name)) {
                echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "warning",
                        title: "Error!",
                        text: "Color name cannot be empty!.",
                        showConfirmButton: true
                    });
                });
            </script>';
                return;
            }
            if ($this->Color->addColorModel($color_name)) {
                echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "success",
                        title: "successfully!",
                        text: "Add color successfully.",
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        window.location.href = "index.php?act=listColors";
                    });
                });
            </script>';
            } else {
                echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "error",
                        title: "Fail!",
                        text: "Please try again!",
                        showConfirmButton: true
                    });
                });
            </script>';
            }
            exit();
        }
    }
}