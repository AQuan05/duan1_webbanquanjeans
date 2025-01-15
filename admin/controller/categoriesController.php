<?php
require_once '../../admin/model/Category.php';

class categoriesController
{
    public $categories;
    public function __construct()
    {
        $this->categories = new Category();
    }
    public function listCategories() {
        $listCategories = $this->categories->listCategories();
    }
}
