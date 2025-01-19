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
        include '../admin/view/pagines/variants/listVariants.php';
    }

    function addVariantsController()
    {
        require_once '../admin/view/pagines/variants/addVariants.php';
        if (isset($_POST['addVariants']) && $_POST['addVariants']) {
            $color = $_POST['color'];
            $size = $_POST['size'];
            $product_id = $_POST['product_id'];
            $this->Variant->addVariantsModel($color, $size, $product_id);
            header('Location: ?act=listVariants');
        }
    }
}
